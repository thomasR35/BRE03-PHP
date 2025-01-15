<?php

include 'config.php';

use mini_projet\Models\Post;
use mini_projet\Managers\PostManager;
use mini_projet\Managers\CategoryManager;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $categoryId = $_POST['category'];


    $authorId = $_POST['author_id'];
    $post = new Post($title, $content, $Id, $author, $created_at);

    $postManager = new PostManager($db);

    $postManager->create($post);

    $categoryManager = new CategoryManager($db);
    $category = $categoryManager->findOne($categoryId);
    $category->addPost($post);
    $categoryManager->update($category);

    header('Location: index.html');
    exit;
}
