<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

require_once 'AbstractManager.php';
require_once 'Post.php';
require_once 'User.php';
require_once 'Category.php';

class PostManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    // Retourne les 4 derniers posts
    public function findLatest(): array
    {
        $query = $this->db->query("
             SELECT posts.*, users.id AS user_id, users.username, categories.id AS category_id, categories.title AS category_title
             FROM posts
             JOIN users ON posts.author = users.id
             JOIN categories ON posts.category_id = categories.id
             ORDER BY posts.created_at DESC LIMIT 4
         ");
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $posts = [];
        foreach ($results as $result) {
            $author = new User($result['user_id'], $result['username'], '', '', '', new DateTime());
            $category = new Category($result['category_id'], $result['category_title'], '');
            $posts[] = new Post($result['id'], $result['title'], $result['content'], $result['excerpt'], new DateTime($result['created_at']), $author, $category);
        }

        return $posts;
    }

    // Retourne un post par son ID
    public function findOne(int $id): ?Post
    {
        $query = $this->db->prepare("
             SELECT posts.*, users.id AS user_id, users.username, categories.id AS category_id, categories.title AS category_title
             FROM posts
             JOIN users ON posts.author = users.id
             JOIN categories ON posts.category_id = categories.id
             WHERE posts.id = :id
         ");
        $query->execute(['id' => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $author = new User($result['user_id'], $result['username'], '', '', '', new DateTime());
            $category = new Category($result['category_id'], $result['category_title'], '');
            return new Post($result['id'], $result['title'], $result['content'], $result['excerpt'], new DateTime($result['created_at']), $author, $category);
        }

        return null;
    }

    // Retourne les posts d'une catégorie donnée
    public function findByCategory(int $categoryId): array
    {
        $query = $this->db->prepare("
             SELECT posts.*, users.id AS user_id, users.username, categories.id AS category_id, categories.title AS category_title
             FROM posts
             JOIN users ON posts.author = users.id
             JOIN categories ON posts.category_id = categories.id
             WHERE posts.category_id = :categoryId
         ");
        $query->execute(['categoryId' => $categoryId]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $posts = [];
        foreach ($results as $result) {
            $author = new User($result['user_id'], $result['username'], '', '', '', new DateTime());
            $category = new Category($result['category_id'], $result['category_title'], '');
            $posts[] = new Post($result['id'], $result['title'], $result['content'], $result['excerpt'], new DateTime($result['created_at']), $author, $category);
        }

        return $posts;
    }
}
