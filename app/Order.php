<?php

namespace App;

class Order
{
    private array $productData = [];
    private array $productNames = [];
    private string $selectedProduct;
    private int $amount = 0;
    private string $person = 'male';

    public function addProductData(string $name, int $amount, int $price): void
    {
        $this->productData[$name] = [$amount, $price];
    }

    public function getProductData(): array
    {
        return $this->productData;
    }

    public function setProductNames(): void
    {
        foreach ($this->productData as $name => $amount) {
            $this->productNames[] = $name;
        }
    }

    /**
     * @return array
     */
    public function getProductNames(): array
    {
        return $this->productNames;
    }

    /**
     * @param string $selectedProduct
     */
    public function setSelectedProduct(string $selectedProduct): void
    {
        $this->selectedProduct = $selectedProduct;
    }


    /**
     * @return string
     */
    public function getSelectedProduct(): string
    {
        return $this->selectedProduct;
    }

    public function setAmount(int $amounts): void
    {
        $this->amount = $amounts;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param string $person
     */
    public function setPerson(string $person): void
    {
        $this->person = $person;
    }

    /**
     * @return string
     */
    public function getPerson(): string
    {
        return $this->person;
    }

}