<?php

namespace App\Supliers;

use App\Interfaces\Supplier;
use App\Product;
use App\ProductCollection;
use App\Sellables\Flower;

class FlowerBase implements Supplier
{
    private ProductCollection $products;

    public function __construct()
    {
        $products = file_get_contents('storage/products.json');
        $product = json_decode($products);
        $this->products = new ProductCollection();

        foreach ($product as $name => $price){
            $this->products->add(
                new Product(
                    new Flower($name), $price->Price
                ),
                $price->Quantity
            );
        }



    }

    public function products(): ProductCollection
    {
        // TODO: Implement products() method.
        return $this->products;
    }
}