<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert as Assert;
use Behat\Step\Given;
use Behat\Step\Then;
use Behat\Step\When;

require "src/Catalogue.php";
require "src/Basket.php";

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private Catalogue $catalogue;
    private Basket $basket;

    public function __construct()
    {
        $this->catalogue = new Catalogue();
        $this->basket = new Basket($this->catalogue);
    }

    #[Given('there is a :product, which costs :price')]
    public function thereIsAWhichCosts($product, $price): void
    {
        $this->catalogue->setProductPrice($product, floatval($price));
    }

    #[When('I add the :product to the basket')]
    public function iAddTheToTheBasket($product): void
    {
        $this->basket->addProduct($product);
    }

    #[Then('I should have :count product(s) in the basket')]
    public function iShouldHaveProductsInTheBasket($count): void
    {
        Assert::assertSame(
            intval($count),
            count($this->basket)
        );
    }

    #[Then('the overall basket price should be :price')]
    public function theOverallBasketPriceShouldBe($price): void
    {
        Assert::assertSame(
            floatval($price),
            $this->basket->getTotalPrice()
        );
    }
}
