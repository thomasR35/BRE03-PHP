# Mini-projet API PHP

Pour ce mini-projet nous allons réutiliser la base `userbase_poo` qu'on avait déjà utilisée.

Elle contient une seule table `users` qui a les champs :

- id
- username
- email
- password
- role
- created_at

Dans ce projet nous allons créer une API en PHP, c'est à dire un moyen d'accéder à notre base de données à distance.

Notre PHP ne va pas générer du HTML mais du JSON, ce qui permettra à une application par exemple en JavaScript de l'interroger.


## Étape 1 : architecture des dossiers et fichiers

Mettez-en place l'architecture de dossiers et fichiers suivante :

- config
	- database.php
- models
	- User.php
- logic
	- user_functions.php
index.php


## Étape 2 : connexion à la base de données

Dans le fichier `database.php`, établissez une connexion avec votre base de données. Faites ensuite un require du fichier `database.php` dans votre fichier `index.php`.


## Étape 3 : la classe User

Dans le fichier `User.php` vous allez créer la classe User, qui aura donc les mêmes champs que ceux présents dans table `users` de la base de données :

- id qui peut être null ou un int
- username qui est une string
- email qui est une string
- password qui est une string
- role qui est une string
- createdAt qui est un DateTime

Son constructeur prend tous les champs sauf l'id en arguments (l'id est null par défaut), tous les champs ont des getters et des setters.

La classe User a également une méthode publique `public function toArray() : array`. Cette méthode doit retourner l'instance de classe sous forme d'un tableau associatif avec le format suivant mais rempli avec les infos e la classe au lieu des `""` d'exemple (vous devrez compléter le code) :

```php
$user = [
	"id" => "",
	"username" => "",
	"email" => "",
	"password" => "",
	"role" => ""
];
``` 

Le tableau ne comprend pas la colonne `created_at`, c'est normal, on va pour le moment s'éviter la manipulation de dates en PHP. 

Pourquoi cette méthode ? Parce que la fonction qui transforme du PHP en JSON ne gère pas les classes, uniquement les tableaux et tableaux  associatifs, du coup il nous faut un moyen de transformer notre classe en tableau associatif.


## Étape 4 : les fonctions de logique de récupération

Nous allons mettre toutes nos fonctions de logique dans le fichier `user_functions.php`.

### Étape 4.1 : getAllUsers()

Voici le prototype de la fonction :

```php
function getAllUsers() : array 
{

}
```

Cette fonction s'appelle `getAllUsers`, ne prend pas de paramètres et renvoie un tableau qui contiendra des instances de la classe `User`.

Elle va donc aller chercher dans la base de données la liste des tous les utilisateurs, puis pour chaque ligne de la table dans la base de données, elle va hydrater une instance de la classe `User`. Enfin elle va placer toutes ces instances dans un tableau et retourner le tableau.

### Étape 4.2 : getUserById()

Voici le prototype de la fonction :

```php
function getUserById(int $id) : ? User 
{

}
```

Cette fonction s'appelle `getUserById`, elle prend en paramètrres un `int $id` et renvoie soit null soit et renvoie une instance de la classe `User`.

Elle va donc aller chercher dans la base de données l'utilisateur qui a l'id passé en paramètres. si cet utilisateur existe elle va utilises ses infos pour hydrater une instance de la classe `User` et retourner cette instance. Si l'utilisateur n'existe pas dans la base de données, elle retourne null.


## Étape 5 : le routing des fonctions de récupération

Dans notre `index.php`, nous allons maintenant devoir récupérer les paramètres `$_GET` pour savoir quelle route nous a été demandée et appeler les bonnes fonctions. Notre `index.php` va commencer par faire un require de `User.php` et un require de `user_functions.php`, pour que nous ayons accès à notre classe et à nos fonctions.

### Étape 5.1 : get_all_users

Si le paramètre `$_GET['route']` vaut `get_all_users`, notre index va appeler la function `getAllUsers` et stocker son retour dans une variable. Ensuite, toujours dans notre condition nous allons créer un nouveau tableau vide.

Nous allons ensuite parcourir le tableau renvoyé par `getAllUsers`et pour chaque tour du tableau, nous allons appeler la méthode `toArray` de l'instance de classe et rajouter son retour au tableau vide.

À la fin notre tableau qui était vide au début doit contenir des tableaux associatifs correspondants à nos instances de classe.

Nous allons ensuite faire un echo de ce tableau au format JSON : 

```php
echo json_encode($tableau);
```

### Étape 5.2 : get_user_by_id

Si le paramètre `$_GET['route']` vaut `get_user_by_id` et que `$_GET['id']` existe et n'est pas vide, notre index va appeler la function `getUserById` en lui pssant l'id récupéré dans les paramètres `$_GET` puis stocker son retour dans une variable. 

Si `getUserById` ne nous a pas renvoyé null, nous allons appeler la méthode `toArray` de l'instance qu'il nous a renvoyé et stocker son retour dans une variable.

Nous allons ensuite faire un echo de cette variable au format JSON : 

```php
echo json_encode($variable);
```


## Étape 6 : tester

Dans la barre d'URL de votre navigateur, vous allez devoir saisir des routes pour tester que tout fonctionne bien :

`[votreurl]/index.php?route=get_all_users` doit afficher un tableau contenant des objets, le tout en JSON.

`[votreurl]/index.php?route=get_user_by_id&id=1` doit afficher un objet, en JSON.