<?php

require_once __DIR__ . '/../src/Config/DataBase.php';
require_once __DIR__ . '/../src/Repositories/ProdutoRepositoryIntrface.php';
require_once __DIR__ . '/../src/Repositories/ProdutoRepository.php';
require_once __DIR__ . '/../src/Controllers/ProdutoController.php';

use App\Controllers\ProdutoController;

$path = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') ?: '/';
$method = $_SERVER['REQUEST_METHOD'];
$controller = new ProdutoController();

if (($path === '/' || $path === '/produtos') && $method === 'GET') {
    $produtos = $controller->index();

} elseif ($path === '/produtos/create' && $method === 'GET') {
    $controller->create();
    exit;

} elseif ($path === '/produtos/store' && $method === 'POST') {
    $controller->store($_POST);

} elseif (preg_match('#^/produtos/([0-9]+)/edit$#', $path, $matches) && $method === 'GET') {
    $controller->edit((int) $matches[1]);
    exit;

} elseif (preg_match('#^/produtos/([0-9]+)/update$#', $path, $matches) && $method === 'POST') {
    $controller->update((int) $matches[1], $_POST);

} elseif (preg_match('#^/produtos/([0-9]+)/delete$#', $path, $matches) && $method === 'POST') {
    $controller->delete((int) $matches[1]);

} else {
    http_response_code(404);
    echo 'Página não encontrada.';
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/style.css">
    <title>Produtos | SGP</title>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
    <main class="mx-auto max-w-6xl px-6 py-10 lg:py-16">
        <div class="mb-10 flex flex-col justify-between gap-6 sm:flex-row sm:items-end">
            <div>
                <p class="mb-3 text-sm font-semibold uppercase tracking-[0.25em] text-cyan-400">SGP • Catálogo</p>
                <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl">Produtos</h1>
                <p class="mt-3 text-lg text-slate-400">Gerencie os produtos cadastrados no sistema.</p>
            </div>
            <a href="/produtos/create" class="inline-flex items-center justify-center rounded-xl bg-cyan-400 px-5 py-3 font-semibold text-slate-950 shadow-lg shadow-cyan-400/20 transition hover:bg-cyan-300 focus:outline-none focus:ring-2 focus:ring-cyan-300 focus:ring-offset-2 focus:ring-offset-slate-950">
                + Novo produto
            </a>
        </div>

        <section class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900/80 shadow-2xl shadow-black/20">
            <?php if (!empty($produtos)) : ?>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[640px] text-left text-sm">
                        <thead class="border-b border-slate-800 bg-slate-900 text-xs uppercase tracking-wider text-slate-400">
                            <tr>
                                <th class="px-6 py-4 font-semibold">ID</th>
                                <th class="px-6 py-4 font-semibold">Nome</th>
                                <th class="px-6 py-4 font-semibold">Preço</th>
                                <th class="px-6 py-4 text-right font-semibold">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800">
                            <?php foreach ($produtos as $produto) : ?>
                                <tr class="transition hover:bg-slate-800/60">
                                    <td class="px-6 py-5 text-slate-500">#<?= (int) $produto['id'] ?></td>
                                    <td class="px-6 py-5 font-medium text-white"><?= htmlspecialchars($produto['nome'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td class="px-6 py-5 font-semibold text-cyan-300">R$ <?= htmlspecialchars((string) $produto['preco'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center justify-end gap-3">
                                            <a class="text-sm font-medium text-cyan-400 transition hover:text-cyan-300" href="/produtos/<?= (int) $produto['id'] ?>/edit">Editar</a>
                                            <form action="/produtos/<?= (int) $produto['id'] ?>/delete" method="POST">
                                                <button class="text-sm font-medium text-rose-400 transition hover:text-rose-300" type="submit">Deletar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <div class="px-6 py-16 text-center">
                    <p class="text-lg font-medium text-slate-300">Nenhum produto encontrado.</p>
                    <p class="mt-2 text-sm text-slate-500">Comece cadastrando o primeiro produto.</p>
                </div>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
