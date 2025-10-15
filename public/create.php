<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Infra\FileProductRepository;
use App\Domain\SimpleProductValidator;
use App\Application\ProductService;

$storagePath = __DIR__ . '/../storage/products.txt';
$repository = new FileProductRepository($storagePath);
$validator = new SimpleProductValidator();
$service = new ProductService($repository, $validator);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$result = $service->create($_POST);

if (isset($result['errors'])) {
    // mostrar erros simples
    echo '<h2>Erro ao cadastrar produto</h2>';
    echo '<ul>';
    foreach ($result['errors'] as $err) {
        echo '<li>' . htmlspecialchars($err) . '</li>';
    }
    echo '</ul>';
    echo '<p><a href="index.php">Voltar</a></p>';
    exit;
}

// sucesso: redirecionar para listagem
header('Location: products.php');
exit;
