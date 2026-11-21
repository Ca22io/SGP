<?php
// No arquivo public/index.php
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    // Altere de '/src/' para '/../src/'
    $base_dir = __DIR__ . '/../src/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) require $file;
});

use App\Config\Database;
use App\Repositories\ProdutoRepository;
use App\Controllers\ProdutoController;

// 1. Prepara as dependências
$db = (new Database())->getConnection();
$repository = new ProdutoRepository($db);

// 2. Instancia o Controller injetando o repositório
$controller = new ProdutoController($repository);

// 3. Lê a ação da URL (ex: index.php?action=store)
$action = $_GET['action'] ?? 'index';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

// 4. Direciona para o método correspondente
switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'salve_create':
        $controller->salve_create();
        break;
    case 'update':
        if ($id) $controller->update((int)$id);
        break;
    case 'save_update':
        if ($id) $controller->save_update((int)$id);
        break;
    case 'delete':
        if ($id) $controller->delete((int)$id);
        break;
    case 'save_delete':
        if ($id) $controller->save_delete((int)$id);
        break;
    case 'index':
    default:
        $controller->index();
        break;
}