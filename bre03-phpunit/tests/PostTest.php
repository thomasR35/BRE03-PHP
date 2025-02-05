<?php

namespace Tests;

use PHPUnit\Framework\TestCase; // Importation de PHPUnit pour exécuter les tests
use InvalidArgumentException; // Importation de l'exception pour gérer les erreurs de validation
use App\Post; // Importation de la classe `Post` à tester

/**
 * Classe de test pour `Post`
 */
class PostTest extends TestCase
{
    /**
     * Teste la création d'un article valide
     *
     * Vérifie que les valeurs passées au constructeur sont bien enregistrées dans les attributs.
     */
    public function testPostCreationValid()
    {
        // Création d'un article avec des valeurs valides
        $post = new Post("Titre", "Contenu", "titre-test");

        // Vérifications des valeurs des attributs
        $this->assertEquals("Titre", $post->getTitle()); // ✅ Vérifie que le titre est bien enregistré
        $this->assertEquals("Contenu", $post->getContent()); // ✅ Vérifie que le contenu est bien enregistré
        $this->assertEquals("titre-test", $post->getSlug()); // ✅ Vérifie que le slug est bien enregistré
        $this->assertFalse($post->isPrivate()); // ✅ Vérifie que le post est public par défaut
    }

    /**
     * Teste que la création d'un article avec un titre vide lève une exception
     */
    public function testPostInvalidTitle()
    {
        $this->expectException(InvalidArgumentException::class);

        // ❌ Doit lever une exception car le titre est vide
        new Post("", "Contenu", "titre-test");
    }

    /**
     * Teste que la création d'un article avec un contenu vide lève une exception
     */
    public function testPostInvalidContent()
    {
        $this->expectException(InvalidArgumentException::class);

        // ❌ Doit lever une exception car le contenu est vide
        new Post("Titre", "", "titre-test");
    }

    /**
     * Teste que la création d'un article avec un slug invalide lève une exception
     */
    public function testPostInvalidSlug()
    {
        $this->expectException(InvalidArgumentException::class);

        // ❌ Doit lever une exception car le slug contient des espaces et des caractères non autorisés
        new Post("Titre", "Contenu", "slug non valide!");
    }
}
