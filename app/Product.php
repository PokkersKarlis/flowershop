<?php

namespace App;

use App\Interfaces\Sellable;

class Product

{
    private Sellable $sellable;
    private int $price;

    public function __construct(Sellable $sellable, int $price)
    {
        $this->sellable = $sellable;
        $this->price = $price;
    }

    /**
     * @return Sellable
     */
    public function sellable(): Sellable
    {
        return $this->sellable;
    }

    /**
     * @return int
     */
    public function price(): int
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function barCode(): string
    {
        return md5($this->sellable->id());
    }
}