<?php

namespace Tests;

require_once __DIR__ . '/../vendor/autoload.php';


use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use App\User;

class UserTest extends TestCase
{
    public function testUserDefaultRoleIsAnonymous()
    {
        $user = new User("John", "Doe", "john@example.com", "Password1!");

        $this->assertEquals(["ANONYMOUS"], $user->getRoles());
    }

    public function testUserWithUserRoleDoesNotHaveAnonymous()
    {
        $user = new User("Alice", "Wonderland", "alice@example.com", "SecurePass1!", ["USER"]);

        $this->assertContains("USER", $user->getRoles());
        $this->assertNotContains("ANONYMOUS", $user->getRoles());
    }

    public function testUserWithAdminRoleDoesNotHaveAnonymous()
    {
        $user = new User("Bob", "Builder", "bob@example.com", "SecurePass1!", ["ADMIN"]);

        $this->assertContains("ADMIN", $user->getRoles());
        $this->assertNotContains("ANONYMOUS", $user->getRoles());
    }

    public function testUserInvalidEmailThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);
        new User("John", "Doe", "invalid-email", "Password1!");
    }

    public function testUserInvalidPasswordThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);
        new User("John", "Doe", "john@example.com", "short");
    }

    public function testAddRoleRemovesAnonymous()
    {
        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $roles = $user->addRole("USER");

        $this->assertContains("USER", $roles);
        $this->assertNotContains("ANONYMOUS", $roles);
    }

    public function testAddInvalidRoleThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);

        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $user->addRole("INVALID_ROLE");
    }

    public function testRemoveLastRoleAddsAnonymous()
    {
        $user = new User("John", "Doe", "john@example.com", "Password1!", ["USER"]);
        $roles = $user->removeRole("USER");

        $this->assertEquals(["ANONYMOUS"], $roles);
    }

    public function testRemoveAdminRoleDowngradesToUser()
    {
        $user = new User("John", "Doe", "john@example.com", "Password1!", ["ADMIN"]);
        $roles = $user->removeRole("ADMIN");

        $this->assertEquals(["ANONYMOUS"], $roles);
    }

    public function testSetFirstNameUpdatesSuccessfully()
    {
        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $user->setFirstName("Jane");

        $this->assertEquals("Jane", $user->getFirstName());
    }

    public function testSetFirstNameThrowsExceptionIfEmpty()
    {
        $this->expectException(InvalidArgumentException::class);

        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $user->setFirstName("");
    }

    public function testSetLastNameUpdatesSuccessfully()
    {
        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $user->setLastName("Smith");

        $this->assertEquals("Smith", $user->getLastName());
    }

    public function testSetLastNameThrowsExceptionIfEmpty()
    {
        $this->expectException(InvalidArgumentException::class);

        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $user->setLastName("");
    }

    public function testSetEmailUpdatesSuccessfully()
    {
        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $user->setEmail("new-email@example.com");

        $this->assertEquals("new-email@example.com", $user->getEmail());
    }

    public function testSetEmailThrowsExceptionIfInvalid()
    {
        $this->expectException(InvalidArgumentException::class);

        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $user->setEmail("invalid-email");
    }

    public function testSetPasswordUpdatesSuccessfully()
    {
        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $user->setPassword("NewPassword1!");

        $this->assertEquals("NewPassword1!", $user->getPassword());
    }

    public function testSetPasswordThrowsExceptionIfInvalid()
    {
        $this->expectException(InvalidArgumentException::class);

        $user = new User("John", "Doe", "john@example.com", "Password1!");
        $user->setPassword("weak");
    }
}
