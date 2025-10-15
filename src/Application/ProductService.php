<?php

declare(strict_types=1);

namespace App\Application;

use App\Contracts\ProductRepository;
use App\Contracts\ProductValidator;

final class ProductService
{
    private ProductRepository $repository;
    private ProductValidator $validator;

    public function __construct(ProductRepository $repository, ProductValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @param array{id?:int,name:string,price:float|string} $input
     * @return array{errors?: string[], product?: array}
     */
    public function create(array $input): array
    {
        $errors = $this->validator->validate($input);

        if (!empty($errors)) {
            return ['errors' => $errors];
        }

        $products = $this->repository->all();

        $lastId = 0;
        if (!empty($products)) {
            $ids = array_map(fn($p) => (int) ($p['id'] ?? 0), $products);
            $lastId = (int) max($ids);
        }

        $id = $lastId + 1;

        $product = [
            'id'    => $id,
            'name'  => trim((string) ($input['name'] ?? '')),
            'price' => (float) ($input['price'] ?? 0),
        ];

        $this->repository->save($product);

        return ['product' => $product];
    }

    /**
     * @return array[] 
     */
    public function list(): array
    {
        return $this->repository->all();
    }
}
