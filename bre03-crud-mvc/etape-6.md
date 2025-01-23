# CRUD en MVC

Les contenus du cours [BRE03 Web Dev Course](https://kornog-dev.github.io/BRE03/) © 2024 par [Mari Doucet](https://github.com/kornog-dev) sont sous licence [CC BY-NC-SA 4.0](https://creativecommons.org/licenses/by-nc-sa/4.0/?ref=chooser-v1)

## Étape 6

Dans cette étape, nous allons gérer les interactions avec votre base de données. Vous pouvez vous inspirer des différents exercices réalisés pendant le module POO (userbase en POO, blog en POO) et de ce que vous aviez appris avec Hugues sur les requêtes avec PDO (https://discord.com/channels/1092386966760329229/1290243753428123683/1326470557121904641).

Dans le fichier `managers/UserManager.php`, créez une classe `UserManager` qui hérite de la classe `AbstractManager`.

Elle n'a pas d'attributs et son constructeur ne fait rien à part appeler le constructeur de sa classe parente.

Elle contient par contre les méthodes publiques nécessaires pour un Manager (https://kornog-dev.github.io/BRE03/php/mvc/#les-managers).

Implémentez ces méthodes en adaptant la situation à la classe `User` et à la table `users` de votre base de données.

>💡 N'oubliez pas de require le fichier `managers/UserManager.php` dans votre fichier `config/autoload.php`

Une fois que cette étape est terminée, envoyez-moi un message sur Discord pour obtenir la suite des consignes.