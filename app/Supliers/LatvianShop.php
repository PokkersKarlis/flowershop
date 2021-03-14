<?php

namespace App\Supliers;

use App\Interfaces\Supplier;
use App\Product;
use App\ProductCollection;
use App\Sellables\Flower;

class LatvianShop implements Supplier
{
    private ProductCollection $products;

    public function __construct()
    {
        $this->products = new ProductCollection();

        $filename = 'storage/latvian-shop.csv';
        $productArray = [];
        if(($products = fopen($filename, 'r')) !== FALSE)
        {
            while(($product = fgetcsv($products, 200, ',')) !== False)
            {
                $productArray[] = $product;
            }
            fclose($products);
        }
        foreach ($productArray as $product){
            $this->products->add(
                new Product(
                    new Flower($product[0]), $product[1]
                ),
                $product[2]
            );
        }
    }

    public function products(): ProductCollection
    {
        // TODO: Implement products() method.
        return $this->products;
    }
}