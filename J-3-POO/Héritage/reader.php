<?php
class User 
{
    protected string $email;
    protected string $password;

    public function __construct(){

    }

    public function login() : array {
    	return ["login" => $this->email, "password" => $this->password];
    }
}
class Reader extends User
{
    private array $favoriteBooks = [];

    public function __construct(string $email, string $password){
    	$this->email = $email;
    	$this->password = $password;
    }

    public function addBookToFavorites(string $book): array {
    	$this->favoriteBooks[] = $book;

    	return $this->favoriteBooks;
    }

    public function removeBookFromFavorites(string $book): array {
    	foreach($this->favoriteBooks as $key => $favoriteBook)
    	{
    		if($favoriteBook === $book)
    		{
    			unset($this->favoriteBooks[$key]);
    		}
    	}

    	return $this->favoriteBooks;
    }  
}

$reader = new Reader("johny.johnjohn@test.fr", "password123");

$reader->addBookToFavorites("Dune");
$reader->addBookToFavorites("Fondation");

echo "Livres favoris : " . implode(", ", $reader->addBookToFavorites("")) . PHP_EOL;

$reader->removeBookFromFavorites("Dune");

echo "Livres favoris après suppression : " . implode(", ", $reader->addBookToFavorites("")) . PHP_EOL;

$loginData = $reader->login();
echo "Email : " . $loginData["login"] . PHP_EOL;
echo "Mot de passe : " . $loginData["password"] . PHP_EOL;
