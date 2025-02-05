<?php

namespace Tests;

require_once __DIR__ . '/../vendor/autoload.php'; // Importe l'autoload de Composer pour charger automatiquement les classes

use InvalidArgumentException; // Utilisation de l'exception pour gérer les erreurs de validation
use PHPUnit\Framework\TestCase; // Importation de PHPUnit pour exécuter les tests
use App\User; // Importation de la classe `User` à tester

/**
 * Classe de test pour `User`
 */
class UserTest extends TestCase
{
    /**
     * Teste que par défaut, un nouvel utilisateur a le rôle "ANONYMOUS"
     */
    public function testUserDefaultRoleIsAnonymous()
    {
        $user = new User("John", "Doe", "john@example.com", "Password1!");

        $this->assertEquals(["ANONYMOUS"], $user->getRoles()); // ✅ Vérifie que le rôle par défaut est bien "ANONYMOUS"
    }

    /**
     * Teste qu'un utilisateur avec le rôle "USER" n'a plus le rôle "ANONYMOUS"
     */
    public function testUserWithUserRoleDoesNotHaveAnonymous()
    {
        $user = new User("Alice", "Wonderland", "alice@example.com", "SecurePass1!", ["USER"]);

        $this->assertContains("USER", $user->getRoles()); // ✅ Vérifie que "USER" est bien attribué
        $this->assertNotContains("ANONYMOUS", $user->getRoles()); // ✅ Vérifie que "ANONYMOUS" a été supprimé
    }

    /**
     * Teste qu'un utilisateur avec le rôle "ADMIN" n'a plus le rôle "ANONYMOUS"
     */
    public function testUserWithAdminRoleDoesNotHaveAnonymous()
    {
        $user = new User("Bob", "Builder", "bob@example.com", "SecurePass1!", ["ADMIN"]);

        $this->assertContains("ADMIN", $user->getRoles()); // ✅ Vérifie que "ADMIN" est bien attribué
        $this->assertNotContains("ANONYMOUS", $user->getRoles()); // ✅ Vérifie que "ANONYMOUS" a été supprimé
    }

    /**
     * Teste qu'un email invalide lève une exception
     */
    public function testUserInvalidEmailThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);
        new User("John", "Doe", "invalid-email", "Password1!"); // ❌ Doit lever une exception
    }

    /**
     * Teste qu'un mot de passe invalide lève une exception
     */
    public function testUserInvalidPasswordThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);
        new User("John", "Doe", "john@example.com", "short"); // ❌ Doit lever une exception
    }

    /**
     * Teste que l'ajout d'un rôle supprime le rôle "ANONYMOUS"
     */
    public function testAddRoleRemovesAnonymous()
    {
        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $roles = $user->addRole("USER");

        $this->assertContains("USER", $roles); // ✅ Vérifie que "USER" est ajouté
        $this->assertNotContains("ANONYMOUS", $roles); // ✅ Vérifie que "ANONYMOUS" a été supprimé
    }

    /**
     * Teste que l'ajout d'un rôle invalide lève une exception
     */
    public function testAddInvalidRoleThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);

        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $user->addRole("INVALID_ROLE"); // ❌ Doit lever une exception
    }

    /**
     * Teste que la suppression du dernier rôle réattribue "ANONYMOUS"
     */
    public function testRemoveLastRoleAddsAnonymous()
    {
        $user = new User("John", "Doe", "john@example.com", "Password1!", ["USER"]);
        $roles = $user->removeRole("USER");

        $this->assertEquals(["ANONYMOUS"], $roles); // ✅ Vérifie que "ANONYMOUS" est réattribué
    }

    /**
     * Teste que la suppression du rôle "ADMIN" rétrograde l'utilisateur à "USER"
     */
    public function testRemoveAdminRoleDowngradesToUser()
    {
        $user = new User("John", "Doe", "john@example.com", "Password1!", ["ADMIN"]);
        $roles = $user->removeRole("ADMIN");

        $this->assertEquals(["ANONYMOUS"], $roles); // ✅ Vérifie que l'utilisateur devient "ANONYMOUS"
    }

    /**
     * Teste que la mise à jour du prénom fonctionne correctement
     */
    public function testSetFirstNameUpdatesSuccessfully()
    {
        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $user->setFirstName("Jane");

        $this->assertEquals("Jane", $user->getFirstName()); // ✅ Vérifie que le prénom est bien mis à jour
    }

    /**
     * Teste que la mise à jour du prénom avec une valeur vide lève une exception
     */
    public function testSetFirstNameThrowsExceptionIfEmpty()
    {
        $this->expectException(InvalidArgumentException::class);

        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $user->setFirstName(""); // ❌ Doit lever une exception
    }

    /**
     * Teste que la mise à jour du nom fonctionne correctement
     */
    public function testSetLastNameUpdatesSuccessfully()
    {
        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $user->setLastName("Smith");

        $this->assertEquals("Smith", $user->getLastName()); // ✅ Vérifie que le nom est bien mis à jour
    }

    /**
     * Teste que la mise à jour du nom avec une valeur vide lève une exception
     */
    public function testSetLastNameThrowsExceptionIfEmpty()
    {
        $this->expectException(InvalidArgumentException::class);

        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $user->setLastName(""); // ❌ Doit lever une exception
    }

    /**
     * Teste que la mise à jour de l'email fonctionne correctement
     */
    public function testSetEmailUpdatesSuccessfully()
    {
        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $user->setEmail("new-email@example.com");

        $this->assertEquals("new-email@example.com", $user->getEmail()); // ✅ Vérifie que l'email est bien mis à jour
    }

    /**
     * Teste que la mise à jour de l'email avec une valeur invalide lève une exception
     */
    public function testSetEmailThrowsExceptionIfInvalid()
    {
        $this->expectException(InvalidArgumentException::class);

        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $user->setEmail("invalid-email"); // ❌ Doit lever une exception
    }

    /**
     * Teste que la mise à jour du mot de passe fonctionne correctement
     */
    public function testSetPasswordUpdatesSuccessfully()
    {
        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $user->setPassword("NewPassword1!");

        $this->assertEquals("NewPassword1!", $user->getPassword()); // ✅ Vérifie que le mot de passe est bien mis à jour
    }

    /**
     * Teste que la mise à jour du mot de passe avec une valeur invalide lève une exception
     */
    public function testSetPasswordThrowsExceptionIfInvalid()
    {
        $this->expectException(InvalidArgumentException::class);

        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $user->setPassword("weak"); // ❌ Doit lever une exception
    }
}
