# CRUD en MVC

Les contenus du cours [BRE03 Web Dev Course](https://kornog-dev.github.io/BRE03/) © 2024 par [Mari Doucet](https://github.com/kornog-dev) sont sous licence [CC BY-NC-SA 4.0](https://creativecommons.org/licenses/by-nc-sa/4.0/?ref=chooser-v1)

## Étape 5

Dans cette étape, nous allons gérer la connexion à votre base de données.

Dans le fichier `managers/AbstractManager.php`, vous allez créer une classe abstraite `AbstractManager`, elle n'a qu'un seul attribut `protected`, appelé `$db`, qui est une instance de la classe `PDO` (fournie par PHP, rien à require).

Le constructeur de la classe ne prend pas de paramètres, par contre, il initialise son attribut `$db` avec les informations de connexion à votre base de données.

>💡 N'oubliez pas de require le fichier `managers/AbstractManager.php` dans votre fichier `config/autoload.php`

Une fois que cette étape est terminée, envoyez-moi un message sur Discord pour obtenir la suite des consignes.