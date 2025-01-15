<?php

namespace App\Managers;

use App\Models\Category;
use App\Models\Post;
use PDO;
use App\Models\User;

class CategoryManager extends AbstractManager
{
    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM categories");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = [];
        foreach ($results as $row) {
            $category = new Category($row['title'], $row['description']);
            $category->setId($row['id']);
            $category->setPosts($this->getPostsForCategory($category->getId()));
            $categories[] = $category;
        }

        return $categories;
    }

    public function findOne(int $id): ?Category
    {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $category = new Category($row['title'], $row['description']);
            $category->setId($row['id']);
            $category->setPosts($this->getPostsForCategory($category->getId()));
            return $category;
        }

        return null;
    }

    public function create(Category $category): void
    {
        $stmt = $this->db->prepare("INSERT INTO categories (title, description) VALUES (?, ?)");
        $stmt->execute([$category->getTitle(), $category->getDescription()]);

        $categoryId = $this->db->lastInsertId();

        foreach ($category->getPosts() as $post) {
            $this->addPostToCategory($post->getId(), $categoryId);
        }
    }

    public function update(Category $category): void
    {
        $stmt = $this->db->prepare("UPDATE categories SET title = ?, description = ? WHERE id = ?");
        $stmt->execute([$category->getTitle(), $category->getDescription(), $category->getId()]);

        $this->removePostsFromCategory($category->getId());

        foreach ($category->getPosts() as $post) {
            $this->addPostToCategory($post->getId(), $category->getId());
        }
    }

    public function delete(int $id): void
    {
        $this->removePostsFromCategory($id);

        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$id]);
    }

    private function getPostsForCategory(int $categoryId): array
    {
        $stmt = $this->db->prepare("
            SELECT posts.* 
            FROM posts
            INNER JOIN post_categories ON posts.id = post_categories.post_id
            WHERE post_categories.category_id = ?
        ");
        $stmt->execute([$categoryId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $posts = [];
        foreach ($results as $row) {
            $post = new Post(
                $row['title'],
                $row['content'],
                $row['excerpt'],
                new \DateTime($row['created_at']),
                new User($row['author_name'], $row['author_email'], $row['author_password'], $row['author_role'])
            );
            $post->setId($row['id']);
            $posts[] = $post;
        }

        return $posts;
    }

    private function addPostToCategory(int $postId, int $categoryId): void
    {
        $stmt = $this->db->prepare("INSERT INTO post_categories (post_id, category_id) VALUES (?, ?)");
        $stmt->execute([$postId, $categoryId]);
    }

    private function removePostsFromCategory(int $categoryId): void
    {
        $stmt = $this->db->prepare("DELETE FROM post_categories WHERE category_id = ?");
        $stmt->execute([$categoryId]);
    }
}
