<?php

declare(strict_types=1);

namespace App\Domain;

interface ProductValidator
{
    /**
     * @param array{id:int,name:string,price:float} $input
     * @return string[] Lista de mensagens de erro
     */
    public function validate(array $input): array;
}