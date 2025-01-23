1. Modifier la méthode list du `UserController` pour qu'elle affiche la liste des utilisateurs:

   - La méthode list du `UserController` doit récupérer tous les utilisateurs de la base de données
     en utilisant la méthode `selectAll` du `UserManager`.
   - Les utilisateurs récupérés doivent être passés au template `list.phtml` pour être affichés.

2. Modifier le template `templates/users/list.phtml` pour afficher la liste des utilisateurs:

   - Le template `list.phtml` doit être modifié pour afficher les utlisateurs récupérés.

   - Utilisez une boucle `foreach` pour parcourir la liste des utilisateurs et afficher leurs
     informations dans un tableau HTML.

   - Ajoutez des liens pour chaque utlisateur permettant de voir les détails, de mettre à jour
     et de supprimer l'utilisateur.

   - Accédez à la page de la liste des utilisateurs `index.php` et vérifiez que tous les utlisateurs
     de la base de données sont affichés dans le tableau.
