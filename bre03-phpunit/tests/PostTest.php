<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use InvalidArgumentException;
use App\Post;


class PostTest extends TestCase
{
    public function testPostCreationValid()
    {
        $post = new Post("Titre", "Contenu", "titre-test");

        $this->assertEquals("Titre", $post->getTitle());
        $this->assertEquals("Contenu", $post->getContent());
        $this->assertEquals("titre-test", $post->getSlug());
        $this->assertFalse($post->isPrivate());
    }

    public function testPostInvalidTitle()
    {
        $this->expectException(InvalidArgumentException::class);
        new Post("", "Contenu", "titre-test");
    }

    public function testPostInvalidContent()
    {
        $this->expectException(InvalidArgumentException::class);
        new Post("Titre", "", "titre-test");
    }

    public function testPostInvalidSlug()
    {
        $this->expectException(InvalidArgumentException::class);
        new Post("Titre", "Contenu", "slug non valide!");
    }
}
