<?php

class Catalogue
{
    private array $prices = [];
    public function setProductPrice(string $product, float $price): void
    {
        $this->prices[$product] = $price;
    }
    public function getProductPrice($product): float
    {
        return $this->prices[$product];
    }
}
