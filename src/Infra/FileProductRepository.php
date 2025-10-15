<?php

// <!-- unico que lê e escreve no arquivo -->

declare(strict_types=1);

namespace App\Infra;

use App\Contracts\ProductRepository;


final class FileProductRepository implements ProductRepository
{
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        $dir = dirname($this->filePath);

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        if (!file_exists($this->filePath)) {
            touch($this->filePath);
        }
    }

    /**
     * @param array{id:int,name:string,price:float} $product
     */
    public function save(array $product):void
    {
        file_put_contents(
            $this->filePath,
            json_encode($product, JSON_UNESCAPED_UNICODE).PHP_EOL,
            FILE_APPEND
        );
    }

    /**
     * @return array[] Lista de produtos
     */
    public function all(): array
    {
        if (!file_exists($this->filePath)) {
            return [];
        }

        $lines = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $products = [];

        foreach ($lines as $line) {
            $data = json_decode($line, true);
            if (is_array($data)) {
                $products[] = $data;
            }
        }

        return $products;
    }
}