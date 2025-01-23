# CRUD en MVC

Les contenus du cours [BRE03 Web Dev Course](https://kornog-dev.github.io/BRE03/) © 2024 par [Mari Doucet](https://github.com/kornog-dev) sont sous licence [CC BY-NC-SA 4.0](https://creativecommons.org/licenses/by-nc-sa/4.0/?ref=chooser-v1)

## Étape 9

Maintenant que vous savez que votre formulaire de création d'utilisateur va appeler la route `check_create_user` nous allons nous occuper d'elle.

Elle a principalement 3 chose à faire : 

1. Récupérer les données du formulaire pour hydrater une instance de la classe `User`
2. Instancier un `UserManager`et transmettre l'instance fraichement créée à sa méthode `create()`
3. Rediriger vers la page de liste des utilisateurs

Implémentez ces trois comportements puis tester le fonctionnement de votre création d'utilisateur (en vérifiant s'il apparait dans votre base de données).

Une fois que vous avez terminé cette étape, envoyez-moi un message sur Discord pour obtenir la suite des consignes.