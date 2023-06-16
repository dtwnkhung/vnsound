<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\SourceRepository;

class ProductRepository extends SourceRepository
{
    /**
     * Returns specified model class name.
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }
    public function getModel()
    {
        return new Product();
    }
    public function getListProduct($length = PHP_INT_MAX)
    {
        $items = Product::take($length)->orderBy('id', 'asc')->get();
        return $items;
    }
}
