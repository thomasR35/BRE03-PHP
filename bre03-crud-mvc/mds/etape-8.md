# CRUD en MVC

Les contenus du cours [BRE03 Web Dev Course](https://kornog-dev.github.io/BRE03/) © 2024 par [Mari Doucet](https://github.com/kornog-dev) sont sous licence [CC BY-NC-SA 4.0](https://creativecommons.org/licenses/by-nc-sa/4.0/?ref=chooser-v1)

## Étape 8

Maintenant que vous savez qui va appeler qui, nous allons revenir à notre route `create_user` que nous avions un peu laissée de côté à l'étape 4 pour aller implémenter des choses dont nous aurions besoin.

La route `create_user` qui correspond donc à la méthode `create()` du `UserController` est une route assez simple à gérer, en effet, elle ne génère pas de logique et se contente d'afficher un template.

Commençons par remplir le template qu'elle appelle : `templates/users/create.phtml`. Ce template va devoir contenir le formulaire qui permet de saisir les informations d'un nouvel utilisateur. Créez ce formulaire HTML dans le template.

Comme tous les formulaires en PHP, il a besoin d'une `action` et d'une `method`, la méthode, ça ne change pas : c'est `post`. Mais à votre avis, laquelle de nos routes sera son `action` ? Mettez-la en place.

Une fois que vous avez terminé cette étape, envoyez-moi un message sur Discord pour obtenir la suite des consignes.



