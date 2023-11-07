<?php

namespace App\Product\Domain\Repository;

use App\Product\Domain\Entity\Product;

interface ProductRepositoryInterface 
{
    public function find($id, $lockMode = null, $lockVersion = null);

    public function save(Product $product) : void;
}