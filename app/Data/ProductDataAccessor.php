<?php

namespace App\Data;

use App\Product;

class ProductDataAccessor {

    public function __construct()
    {
        
    }

    public function getProducts()
    {
        return Product::get();
    }
}