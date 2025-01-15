<?php

namespace mini_projet\managers;

require_once __DIR__ . '/AbstractManager.php';
require_once __DIR__ . '/../managers/PostManager.php';

use mini_projet\models\Post;
use mini_projet\models\User;
use mini_projet\models\Category;
use PDO;

class PostManager extends AbstractManager
{
    public function findAll(): array
    {
        $stmt = $this->db->query("
            SELECT posts.*, users.id AS author_id, users.name AS author_name, users.email AS author_email
            FROM posts
            INNER JOIN users ON posts.author = users.id
        ");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $posts = [];
        foreach ($results as $row) {

            $author = new User($row['author_name'], $row['author_email'], '', '');
            $author->setId($row['author_id']);

            $post = new Post(
                $row['title'],
                $row['content'],
                $row['excerpt'],
                new \DateTime($row['created_at']),
                $author
            );
            $post->setId($row['id']);

            $post->setCategories($this->getCategoriesForPost($post->getId()));

            $posts[] = $post;
        }

        return $posts;
    }

    public function findOne(int $id): ?Post
    {
        $stmt = $this->db->prepare("
            SELECT posts.*, users.id AS author_id, users.name AS author_name, users.email AS author_email
            FROM posts
            INNER JOIN users ON posts.author = users.id
            WHERE posts.id = ?
        ");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $author = new User($row['author_name'], $row['author_email'], '', '');
            $author->setId($row['author_id']);

            $post = new Post(
                $row['title'],
                $row['content'],
                $row['excerpt'],
                new \DateTime($row['created_at']),
                $author
            );
            $post->setId($row['id']);
            $post->setCategories($this->getCategoriesForPost($post->getId()));

            return $post;
        }

        return null;
    }

    public function create(Post $post): void
    {
        if (empty($post->getTitle()) || empty($post->getContent())) {
            throw new \InvalidArgumentException("Le titre et le contenu ne peuvent pas être vides.");
        }

        $stmt = $this->db->prepare("
        INSERT INTO posts (title, content, excerpt, created_at, author) 
        VALUES (?, ?, ?, ?, ?)
    ");
        $stmt->execute([
            $post->getTitle(),
            $post->getContent(),
            $post->getExcerpt(),
            $post->getCreatedAt()->format('Y-m-d H:i:s'),
            $post->getAuthor()->getId()
        ]);

        $postId = $this->db->lastInsertId();

        foreach ($post->getCategories() as $category) {
            $this->addCategoryToPost($postId, $category->getId());
        }
    }


    public function update(Post $post): void
    {
        $stmt = $this->db->prepare("
            UPDATE posts SET title = ?, content = ?, excerpt = ?, created_at = ?, author = ? WHERE id = ?
        ");
        $stmt->execute([
            $post->getTitle(),
            $post->getContent(),
            $post->getExcerpt(),
            $post->getCreatedAt()->format('Y-m-d H:i:s'),
            $post->getAuthor()->getId(),
            $post->getId()
        ]);

        $this->removeCategoriesFromPost($post->getId());

        foreach ($post->getCategories() as $category) {
            $this->addCategoryToPost($post->getId(), $category->getId());
        }
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("SELECT id FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        $post = $stmt->fetch();

        if ($post) {
            $this->removeCategoriesFromPost($id);

            $stmt = $this->db->prepare("DELETE FROM posts WHERE id = ?");
            $stmt->execute([$id]);
        }
    }


    private function getCategoriesForPost(int $postId): array
    {
        $stmt = $this->db->prepare("
        SELECT categories.* 
        FROM categories
        INNER JOIN post_categories ON categories.id = post_categories.category_id
        WHERE post_categories.post_id = ?
    ");
        $stmt->execute([$postId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = [];
        foreach ($results as $row) {
            $category = new Category($row['title'], $row['description']);
            $category->setId($row['id']);
            $categories[] = $category;
        }

        return $categories;
    }

    private function removeCategoriesFromPost(int $postId): void
    {
        $stmt = $this->db->prepare("DELETE FROM post_categories WHERE post_id = ?");
        $stmt->execute([$postId]);
    }

    private function addCategoryToPost(int $postId, int $categoryId): void
    {
        $stmt = $this->db->prepare("SELECT id FROM categories WHERE id = ?");
        $stmt->execute([$categoryId]);
        $category = $stmt->fetch();

        if ($category) {
            $stmt = $this->db->prepare("INSERT INTO post_categories (post_id, category_id) VALUES (?, ?)");
            $stmt->execute([$postId, $categoryId]);
        }
    }
}
