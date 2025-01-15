<?php
class Character 
{
    protected int $life;
    protected string $name;

    public function __construct() {
    }

    public function getLife(): int {
        return $this->life;
    }

    public function setLife(int $life): void {
        $this->life = $life;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function introduce(): string {
        return "Bonjour, je m'appelle " . $this->name;
    }
}
class Warrior extends Character 
{
    private int $energy;

    public function __construct(int $life, string $name, int $energy) {
        $this->life = $life;
        $this->name = $name;
        $this->energy = $energy;
    }

    public function getEnergy(): int {
        return $this->energy;
    }

    public function setEnergy(int $energy): void {
        $this->energy = $energy;
    }

    public function introduceWarrior(): string {
        return $this->introduce() . ", j'ai " . $this->life . " points de vie et " . $this->energy . " points d'énergie.";
    }
}
class Mage extends Character 
{
    private int $mana;

    public function __construct(int $life, string $name, int $mana) {
        $this->life = $life;
        $this->name = $name;
        $this->mana = $mana;
    }

    public function getMana(): int {
        return $this->mana;
    }

    public function setMana(int $mana): void {
        $this->mana = $mana;
    }

    public function introduceMage(): string {
        return $this->introduce() . ", j'ai " . $this->life . " points de vie et " . $this->mana . " points de mana.";
    }
}
$character = new Character();
$character->setName("Personnage générique");
$character->setLife(100);
echo $character->introduce() . PHP_EOL;

$warrior = new Warrior(150, "Aragorn", 80);
echo $warrior->introduceWarrior() . PHP_EOL;

$mage = new Mage(120, "Gandalf", 200);
echo $mage->introduceMage() . PHP_EOL;
