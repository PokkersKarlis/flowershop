<?php

namespace App\Interfaces;

use App\ProductCollection;

interface Supplier

{
    public function products():ProductCollection;
}