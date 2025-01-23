# CRUD en MVC

Les contenus du cours [BRE03 Web Dev Course](https://kornog-dev.github.io/BRE03/) © 2024 par [Mari Doucet](https://github.com/kornog-dev) sont sous licence [CC BY-NC-SA 4.0](https://creativecommons.org/licenses/by-nc-sa/4.0/?ref=chooser-v1)

## Étape 1 : Mise en place du Routeur

Vous allez utiliser ce que vous avez appris dans l'exercice précédent pour mettre en place un routeur. Voici la liste des routes et des méthodes correspondantes :

- `index.php?route=show_user` -> la méthode `show()` du `UserController`
- `index.php?route=create_user` -> la méthode `create()` du `UserController`
- `index.php?route=check_create_user` -> la méthode `checkCreate()` du `UserController`
- `index.php?route=update_user` -> la méthode `update()` du `UserController`
- `index.php?route=check_update_user` -> la méthode `checkUpdate()` du `UserController`
- `index.php?route=delete_user` -> la méthode `delete()` du `UserController`
- Dans tous les autres cas : la méthode `list()` du `UserController`

Pour le moment, vous n'avez pas de controller, du coup dans les accolades de vos conditions, notez simplement en commentaire le nom de controller et de la méthode qui devra être appelée.

En observant la liste des templates que vous avez dû créer à l'étape 0 et en la comparant avec la liste des méthodes du `UserController` mentionnées ci-dessus, déduisez quelle méthode devra afficher quel template.

Préremplissez vos templates avec le strict minimum, la structure de base d'une page pour le layout avec le require du template contenu dans la variable `$route` et un titre décrivant le nom de la page pour les autres. Inspirez-vous des consignes de l'exercice sur le Routeur.

>💡 N'oubliez pas de require le fichier `config/Router.php` dans votre fichier `config/autoload.php`

Il y a plus de templates que de méthodes, que pouvez-vous en déduire ? Répondez-moi dans un message sur Discord.