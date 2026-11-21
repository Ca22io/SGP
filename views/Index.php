<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Lista de Produtos</title>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen">

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <!-- Cabeçalho -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-slate-900">
                        Produtos
                    </h1>
                    <span class="inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-0.5 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-600/20">
                        <?= is_array($produtos ?? null) ? count($produtos) : 0 ?> cadastrados
                    </span>
                </div>
                <p class="mt-1 text-sm text-slate-500">
                    Gerencie o catálogo de produtos cadastrados no sistema.
                </p>
            </div>

            <a href="/index.php?action=create"
               class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Adicionar Produto
            </a>
        </div>

        <!-- Card da Tabela -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50/80">
                        <tr>
                            <th scope="col" class="py-3.5 pl-6 pr-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500 w-20">
                                ID
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Produto
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-right text-xs font-semibold uppercase tracking-wider text-slate-500 w-36">
                                Preço
                            </th>
                            <th scope="col" class="py-3.5 pl-3 pr-6 text-right text-xs font-semibold uppercase tracking-wider text-slate-500 w-44">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        <?php if (empty($produtos) || !is_array($produtos)): ?>
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400 mb-3">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-semibold text-slate-900">Nenhum produto encontrado</h3>
                                    <p class="mt-1 text-sm text-slate-500">Comece cadastrando o primeiro item no catálogo.</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($produtos as $produto): ?>
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-mono text-slate-500">
                                        #<?= htmlspecialchars((string) $produto['id']) ?>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm font-medium text-slate-900">
                                            <?= htmlspecialchars($produto['nome']) ?>
                                        </div>
                                        <?php if (!empty($produto['descricao'])): ?>
                                            <div class="text-xs text-slate-500 line-clamp-1 max-w-md mt-0.5">
                                                <?= htmlspecialchars($produto['descricao']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-right text-sm font-semibold tabular-nums text-emerald-700">
                                        R$ <?= number_format((float) $produto['preco'], 2, ',', '.') ?>
                                    </td>
                                    <td class="whitespace-nowrap py-4 pl-3 pr-6 text-right text-sm font-medium">
                                        <div class="inline-flex items-center justify-end gap-2">
                                            <a href="/index.php?action=update&id=<?= urlencode((string) $produto['id']) ?>"
                                               class="inline-flex items-center rounded-md bg-amber-50 px-2.5 py-1.5 text-xs font-semibold text-amber-700 ring-1 ring-inset ring-amber-600/20 hover:bg-amber-100 transition">
                                                Editar
                                            </a>
                                            <a href="/index.php?action=delete&id=<?= urlencode((string) $produto['id']) ?>"
                                               class="inline-flex items-center rounded-md bg-rose-50 px-2.5 py-1.5 text-xs font-semibold text-rose-700 ring-1 ring-inset ring-rose-600/20 hover:bg-rose-100 transition">
                                                Excluir
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>