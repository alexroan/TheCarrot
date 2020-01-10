<?php

namespace App\Data;

use App\Product;

class ProductDataAccessor
{

    public function __construct()
    {
    }

    public function getProducts()
    {
        return Product::get();
    }

    public function getProduct(int $id)
    {
        return Product::whereId($id)
            ->first();
    }

    public function getProductByProductId(int $id)
    {
        return Product::where('product_id', $id)
            ->first();
    }
}
