<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Excluir Produto</title>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen">

    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- Navegação de retorno -->
        <div class="mb-6">
            <a href="index.php" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-500 hover:text-slate-800 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Voltar para produtos
            </a>
        </div>

        <!-- Card de Confirmação -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 sm:p-8">
            <?php if (!isset($produto) || $produto === null): ?>
                <div class="text-center py-6">
                    <h2 class="text-lg font-semibold text-slate-900">Produto não encontrado</h2>
                    <p class="mt-1 text-sm text-slate-500">O item solicitado não existe ou já foi removido.</p>
                    <div class="mt-6">
                        <a href="index.php" class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 transition">
                            Voltar à lista
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="flex items-start gap-4">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-rose-50 text-rose-600 ring-1 ring-inset ring-rose-600/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900">
                            Excluir Produto
                        </h1>
                        <p class="mt-1 text-sm text-slate-500">
                            Essa ação é permanente e não poderá ser desfeita. Confirme os dados do item abaixo antes de prosseguir.
                        </p>
                    </div>
                </div>

                <!-- Resumo do Produto -->
                <div class="mt-6 rounded-lg bg-slate-50 border border-slate-200/80 p-4 space-y-2">
                    <div class="flex items-center justify-between text-xs text-slate-500">
                        <span class="font-mono">ID #<?= htmlspecialchars((string) $produto->getId()) ?></span>
                        <span class="font-semibold text-emerald-700 tabular-nums">
                            R$ <?= number_format($produto->getPreco(), 2, ',', '.') ?>
                        </span>
                    </div>
                    <p class="text-base font-semibold text-slate-900">
                        <?= htmlspecialchars($produto->getNome()) ?>
                    </p>
                    <?php if (!empty($produto->getDescricao())): ?>
                        <p class="text-sm text-slate-600">
                            <?= htmlspecialchars($produto->getDescricao()) ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Formulário de Exclusão -->
                <form action="index.php?action=save_delete&id=<?= urlencode((string) $produto->getId()) ?>" method="POST" class="mt-6 pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="index.php"
                       class="rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 transition">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-rose-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-rose-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-600 transition">
                        Confirmar Exclusão
                    </button>
                </form>
            <?php endif; ?>
        </div>

    </div>

</body>
</html>