<?php
class Weapon
{
    private string $name;
    private int $damages;

    public function __construct(string $name, int $damages)
    {
        $this->name = $name;
        $this->damages = $damages;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDamages(): int
    {
        return $this->damages;
    }

    public function setDamages(int $damages): void
    {
        $this->damages = $damages;
    }

    public function strike(): string
    {
        return "Mais aïeuh! <br>";
    }
}
?>