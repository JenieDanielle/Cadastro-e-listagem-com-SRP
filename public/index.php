<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Cadastrar Produto</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>

    <form action="create.php" method="POST" class="grid grid-cols-1 h-100 w-100 p-5 shadow-lg">
        <h1 class="text-[20px] font-medium mb-5">Cadastrar Produto</h1>
        <label for="name">Nome:</label>
        <input id="name" name="name" type="text" class="border boorder-gray-200 rounded-sm pl-3" required><br><br>

        <label for="price" class="-mt-10">Preço:</label>
        <input id="price" name="price" type="text" class="-mt-4 border boorder-gray-200 rounded-sm pl-3 " required placeholder="ex: 120.50"><br><br>

        <button type="submit" class="bg-black rounded-sm hover:bg-black/40 hover:text-black text-white font-medium">Cadastrar</button>
        <p class="mt-5 hover:text-black/50"><a href="products.php">Ver produtos cadastrados</a></p>
    </form>
</body>
</html>
