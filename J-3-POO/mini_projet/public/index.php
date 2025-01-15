<?php

require_once __DIR__ . '/../managers/AbstractManager.php';
require_once __DIR__ . '/../managers/PostManager.php';

use mini_projet\managers\PostManager;

$postManager = new PostManager();

$posts = $postManager->findAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mini Projet</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <header>
    <h1>Gestion des Catégories</h1>
  </header>

  <main>
    <section id="categories">
      <h2>Liste des catégories</h2>
      <ul id="category-list">
        <?php

        $stmt = $db->query("SELECT id, title FROM categories");
        while ($category = $stmt->fetch()) {
          echo "<li>{$category['title']}</li>";
        }
        ?>
      </ul>
    </section>

    <section id="posts">
      <h2>Posts</h2>
      <ul id="post-list">
        <?php

        foreach ($posts as $post) {
          echo "<div class='post'>";
          echo "<h2>{$post->getTitle()}</h2>";
          echo "<p><strong>Contenu:</strong> {$post->getContent()}</p>";
          echo "<p><strong>Catégories:</strong> ";
          $categories = $post->getCategories();
          foreach ($categories as $category) {
            echo "<span class='category'>{$category->getTitle()}</span>, ";
          }
          echo "</p>";
          echo "</div><hr>";
        }
        ?>
      </ul>
    </section>

    <section id="form">
      <form id="add-post-form" method="POST" action="add_post.php">
        <label for="title">Titre:</label>
        <input type="text" id="title" name="title" required>

        <label for="content">Contenu:</label>
        <textarea id="content" name="content" required></textarea>

        <label for="category">Catégorie:</label>
        <select id="category" name="category" required>
          <?php
          $stmt = $db->query("SELECT id, title FROM categories");
          while ($category = $stmt->fetch()) {
            echo "<option value='{$category['id']}'>{$category['title']}</option>";
          }
          ?>
        </select>

        <button type="submit">Ajouter l'article</button>
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Mini Projet</p>
  </footer>

  <script src="script.js"></script>
</body>

</html>