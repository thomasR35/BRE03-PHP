<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Post;
use App\User;
use App\Guard;

class GuardTest extends TestCase
{
    public function testGiveAccessToPrivatePostAsAnonymousThrowsException()
    {
        $this->expectException(\Exception::class);

        $post = new Post("Titre", "Contenu", "titre-test", true);
        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $guard = new Guard();

        $guard->giveAccess($post, $user);
    }

    public function testGiveAccessToPrivatePostAsUserBecomesAdmin()
    {
        $post = new Post("Titre", "Contenu", "titre-test", true);
        $user = new User("Alice", "Wonderland", "alice@example.com", "SecurePass1!", ["USER"]);
        $guard = new Guard();

        $guard->giveAccess($post, $user);

        $this->assertContains("ADMIN", $user->getRoles());
    }

    public function testGiveAccessToPrivatePostAsAdminDoesNothing()
    {
        $post = new Post("Titre", "Contenu", "titre-test", true);
        $user = new User("Bob", "Builder", "bob@example.com", "SecurePass1!", ["ADMIN"]);
        $guard = new Guard();

        $rolesBefore = $user->getRoles();
        $guard->giveAccess($post, $user);
        $rolesAfter = $user->getRoles();

        $this->assertEquals($rolesBefore, $rolesAfter);
    }

    public function testGiveAccessToPublicPostAsAnonymousBecomesUser()
    {
        $post = new Post("Titre", "Contenu", "titre-test", false);
        $user = new User("Charlie", "Chaplin", "charlie@example.com", "SecurePass1!");
        $guard = new Guard();

        $guard->giveAccess($post, $user);

        $this->assertContains("USER", $user->getRoles());
    }

    public function testGiveAccessToPublicPostAsUserOrAdminDoesNothing()
    {
        $post = new Post("Titre", "Contenu", "titre-test", false);
        $user = new User("Diane", "Smith", "diane@example.com", "SecurePass1!", ["USER"]);
        $guard = new Guard();

        $rolesBefore = $user->getRoles();
        $guard->giveAccess($post, $user);
        $rolesAfter = $user->getRoles();

        $this->assertEquals($rolesBefore, $rolesAfter);
    }

    public function testRemoveAccessFromPrivatePostAsUserBecomesAnonymous()
    {
        $post = new Post("Titre", "Contenu", "titre-test", true);
        $user = new User("Eve", "Adams", "eve@example.com", "SecurePass1!", ["USER"]);
        $guard = new Guard();

        $guard->removeAccess($post, $user);

        $this->assertEquals(["ANONYMOUS"], $user->getRoles());
    }

    public function testRemoveAccessFromPrivatePostAsAdminBecomesUser()
    {
        $post = new Post("Titre", "Contenu", "titre-test", true);
        $user = new User("Frank", "Doe", "frank@example.com", "SecurePass1!", ["ADMIN"]);
        $guard = new Guard();

        $guard->removeAccess($post, $user);

        $this->assertEquals(["USER"], $user->getRoles());
    }

    public function testRemoveAccessFromPublicPostAsUserBecomesAnonymous()
    {
        $post = new Post("Titre", "Contenu", "titre-test", false);
        $user = new User("George", "Harrison", "george@example.com", "SecurePass1!", ["USER"]);
        $guard = new Guard();

        $guard->removeAccess($post, $user);

        $this->assertEquals(["ANONYMOUS"], $user->getRoles());
    }

    public function testRemoveAccessFromPublicPostAsAdminBecomesUser()
    {
        $post = new Post("Titre", "Contenu", "titre-test", false);
        $user = new User("Harry", "Potter", "harry@example.com", "SecurePass1!", ["ADMIN"]);
        $guard = new Guard();

        $guard->removeAccess($post, $user);

        $this->assertEquals(["USER"], $user->getRoles());
    }
}
