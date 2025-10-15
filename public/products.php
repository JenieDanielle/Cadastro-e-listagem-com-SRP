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

$products = $service->list();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Produtos</title>
</head>
<body>
    <h1>Produtos Cadastrados</h1>

    <?php if (empty($products)): ?>
        <p>Nenhum produto cadastrado.</p>
    <?php else: ?>
        <table border="1" cellpadding="8">
            <thead>
                <tr><th>ID</th><th>Nome</th><th>Preço</th></tr>
            </thead>
            <tbody>
            <?php foreach ($products as $p): ?>
                <tr>
                    <td><?= htmlspecialchars((string)($p['id'] ?? '')) ?></td>
                    <td><?= htmlspecialchars((string)($p['name'] ?? '')) ?></td>
                    <td>R$ <?= number_format((float)($p['price'] ?? 0), 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <p><a href="index.php">Cadastrar novo produto</a></p>
</body>
</html>
