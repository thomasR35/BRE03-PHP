# Exercice Authentification en MVC

## GitHub

Créez un repository GitHub public avec un README et appelez-le `bre03-auth-mvc`.
Clonez-le dans le dossier `sites/php` de votre IDE.

## Bases de données

Il vous faudra une table `users` où vos utilisateurs ont au moins un email et un mot de passe chiffré (vous pouvez réutiliser une table d'un exercice précédent).


## Routeur : les routes à implémenter

- `?route=connexion` : affichera un formulaire de connexion
- `?route=check-connexion` : sera l'action du formulaire de connexion, connectera l'utilisateur si ses infos sont bonnes et redirigera l'utilisateur
- `?route=inscription` : affichera un formulaire d'inscription
- `?route=check-inscription` : sera l'action du formulaire d'inscription, appelera le manager pour créer l'utilisateur, connectera l'utilisateur et redirigera l'utilisateur
- `?route=espace-perso` : affichera de username de l'utilisateur connecté s'il y en a un, sinon redirigera vers la connexion


## Controlleurs

### AuthController

Vous devrez créer un `AuthController` qui gerera la connexion et l'inscription.

### PageController

Vous devrez créer un `PageController` qui gerera les pages `espace perso` et `404`.


## Managers

### AbstractManager

Il vous faudra un `AbstractManager` qui gêrera la connexion à votre base de données

### UserManager

Il vous faudra un `UserManager` qui hérite d'`AbstractManager` et permet de créer et récupérer des utilisateurs dans la base de données.


## Models

Il vous faudra une classe `User` qui correspondra à votre table en base de données.


## Templates

Il vous faudra des templates pour chacune de vos pages qui ont de l'affichage ainsi qu'un layout.


## Fichiers

Il vous faudra un index et un autoload.