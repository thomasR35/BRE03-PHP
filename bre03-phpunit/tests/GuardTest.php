<?php

namespace Tests;

use PHPUnit\Framework\TestCase; // Importation de PHPUnit pour exécuter les tests
use App\Post;  // Importation de la classe `Post` pour les articles
use App\User;  // Importation de la classe `User` pour la gestion des utilisateurs
use App\Guard; // Importation de la classe `Guard` qui gère les accès

/**
 * Classe de test pour `Guard`
 */
class GuardTest extends TestCase
{
    /**
     * Teste qu'un utilisateur anonyme ne peut pas accéder à un post privé.
     *
     * Une exception doit être levée.
     */
    public function testGiveAccessToPrivatePostAsAnonymousThrowsException()
    {
        $this->expectException(\Exception::class);

        $post = new Post("Titre", "Contenu", "titre-test", true); // 🔒 Post privé
        $user = new User("John", "Doe", "john@example.com", "Password1!"); // 👤 Utilisateur ANONYMOUS
        $guard = new Guard();

        // ❌ Lève une exception car l'utilisateur est anonyme
        $guard->giveAccess($post, $user);
    }

    /**
     * Teste qu'un utilisateur "USER" accédant à un post privé devient "ADMIN".
     */
    public function testGiveAccessToPrivatePostAsUserBecomesAdmin()
    {
        $post = new Post("Titre", "Contenu", "titre-test", true); // 🔒 Post privé
        $user = new User("Alice", "Wonderland", "alice@example.com", "SecurePass1!", ["USER"]); // 👤 Utilisateur USER
        $guard = new Guard();

        $guard->giveAccess($post, $user);

        $this->assertContains("ADMIN", $user->getRoles()); // ✅ Vérifie que l'utilisateur est devenu ADMIN
    }

    /**
     * Teste qu'un utilisateur "ADMIN" accédant à un post privé ne change pas de rôle.
     */
    public function testGiveAccessToPrivatePostAsAdminDoesNothing()
    {
        $post = new Post("Titre", "Contenu", "titre-test", true); // 🔒 Post privé
        $user = new User("Bob", "Builder", "bob@example.com", "SecurePass1!", ["ADMIN"]); // 👤 Utilisateur ADMIN
        $guard = new Guard();

        $rolesBefore = $user->getRoles();
        $guard->giveAccess($post, $user);
        $rolesAfter = $user->getRoles();

        $this->assertEquals($rolesBefore, $rolesAfter); // ✅ Vérifie qu'il n'y a aucun changement de rôle
    }

    /**
     * Teste qu'un utilisateur anonyme accédant à un post public devient "USER".
     */
    public function testGiveAccessToPublicPostAsAnonymousBecomesUser()
    {
        $post = new Post("Titre", "Contenu", "titre-test", false); // 🔓 Post public
        $user = new User("Charlie", "Chaplin", "charlie@example.com", "SecurePass1!"); // 👤 Utilisateur ANONYMOUS
        $guard = new Guard();

        $guard->giveAccess($post, $user);

        $this->assertContains("USER", $user->getRoles()); // ✅ Vérifie que l'utilisateur est devenu USER
    }

    /**
     * Teste qu'un utilisateur "USER" ou "ADMIN" accédant à un post public ne change pas de rôle.
     */
    public function testGiveAccessToPublicPostAsUserOrAdminDoesNothing()
    {
        $post = new Post("Titre", "Contenu", "titre-test", false); // 🔓 Post public
        $user = new User("Diane", "Smith", "diane@example.com", "SecurePass1!", ["USER"]); // 👤 Utilisateur USER
        $guard = new Guard();

        $rolesBefore = $user->getRoles();
        $guard->giveAccess($post, $user);
        $rolesAfter = $user->getRoles();

        $this->assertEquals($rolesBefore, $rolesAfter); // ✅ Vérifie qu'il n'y a aucun changement de rôle
    }

    /**
     * Teste qu'un utilisateur "USER" perd l'accès à un post privé et devient "ANONYMOUS".
     */
    public function testRemoveAccessFromPrivatePostAsUserBecomesAnonymous()
    {
        $post = new Post("Titre", "Contenu", "titre-test", true); // 🔒 Post privé
        $user = new User("Eve", "Adams", "eve@example.com", "SecurePass1!", ["USER"]); // 👤 Utilisateur USER
        $guard = new Guard();

        $guard->removeAccess($post, $user);

        $this->assertEquals(["ANONYMOUS"], $user->getRoles()); // ✅ Vérifie que l'utilisateur est devenu ANONYMOUS
    }

    /**
     * Teste qu'un utilisateur "ADMIN" perd l'accès à un post privé et devient "USER".
     */
    public function testRemoveAccessFromPrivatePostAsAdminBecomesUser()
    {
        $post = new Post("Titre", "Contenu", "titre-test", true); // 🔒 Post privé
        $user = new User("Frank", "Doe", "frank@example.com", "SecurePass1!", ["ADMIN"]); // 👤 Utilisateur ADMIN
        $guard = new Guard();

        $guard->removeAccess($post, $user);

        $this->assertEquals(["USER"], $user->getRoles()); // ✅ Vérifie que l'utilisateur est devenu USER
    }

    /**
     * Teste qu'un utilisateur "USER" perd l'accès à un post public et devient "ANONYMOUS".
     */
    public function testRemoveAccessFromPublicPostAsUserBecomesAnonymous()
    {
        $post = new Post("Titre", "Contenu", "titre-test", false); // 🔓 Post public
        $user = new User("George", "Harrison", "george@example.com", "SecurePass1!", ["USER"]); // 👤 Utilisateur USER
        $guard = new Guard();

        $guard->removeAccess($post, $user);

        $this->assertEquals(["ANONYMOUS"], $user->getRoles()); // ✅ Vérifie que l'utilisateur est devenu ANONYMOUS
    }

    /**
     * Teste qu'un utilisateur "ADMIN" perd l'accès à un post public et devient "USER".
     */
    public function testRemoveAccessFromPublicPostAsAdminBecomesUser()
    {
        $post = new Post("Titre", "Contenu", "titre-test", false); // 🔓 Post public
        $user = new User("Harry", "Potter", "harry@example.com", "SecurePass1!", ["ADMIN"]); // 👤 Utilisateur ADMIN
        $guard = new Guard();

        $guard->removeAccess($post, $user);

        $this->assertEquals(["USER"], $user->getRoles()); // ✅ Vérifie que l'utilisateur est devenu USER
    }
}
