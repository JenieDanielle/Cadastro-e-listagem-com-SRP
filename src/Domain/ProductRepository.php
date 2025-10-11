<?php

declare(strict_types=1);

namespace App\Domain;

interface ProductRepository
{
    /**
     * @param array{id:int,name:string,price:float} $product
     */
    public function save(array $product): void;

    /**
     * @return array[] Lista de produtos
     */
    public function all(): array;
}