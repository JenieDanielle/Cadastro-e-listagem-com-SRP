<?php
 declare(strict_types=1);

 namespace App\Domain;

 use App\Contracts\ProductValidator;

 final class SimpleProductValidator implements ProductValidator
 {
    public function validate(array $input): array
    {
        $errors = [];

        $name = $input['name'] ?? '';
        $price = $input['price'] ?? '';

        if (strlen($name) < 2){
            $errors[] = 'Precisa ter um nome com mais de 2 caracteres';
        } else if (strlen($name) > 100) {
            $errors[] = 'O nome pode ter até 100 caracteres';
        }

        if (!is_numeric($price) || $price < 0){
            $errors[] = 'Insira um valor maior ou igual a 0';
        }

        return $errors;
    }


 }