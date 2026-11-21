<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Criar Produto</title>
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

        <!-- Cabeçalho -->
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-slate-900">
                Novo Produto
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Preencha as informações abaixo para adicionar um item ao catálogo.
            </p>
        </div>

        <!-- Card do Formulário -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 sm:p-8">
            <form action="index.php?action=salve_create" method="POST" class="space-y-6">

                <div>
                    <label for="nome" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Nome do produto
                    </label>
                    <input type="text"
                           id="nome"
                           name="nome"
                           placeholder="Ex: Teclado Mecânico RGB"
                           required
                           class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600/20 transition">
                </div>

                <div>
                    <label for="descricao" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Descrição
                    </label>
                    <textarea id="descricao"
                              name="descricao"
                              rows="4"
                              placeholder="Descreva as especificações ou detalhes principais do produto..."
                              required
                              class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600/20 transition"></textarea>
                </div>

                <div>
                    <label for="preco" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Preço unitário
                    </label>
                    <div class="relative rounded-lg shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                            <span class="text-slate-500 text-sm font-medium">R$</span>
                        </div>
                        <input type="number"
                               step="0.01"
                               min="0"
                               id="preco"
                               name="preco"
                               placeholder="0,00"
                               required
                               class="block w-full rounded-lg border border-slate-300 bg-white pl-10 pr-3.5 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 tabular-nums focus:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600/20 transition">
                    </div>
                </div>

                <!-- Ações do Formulário -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="index.php"
                       class="rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 transition">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition">
                        Salvar Produto
                    </button>
                </div>

            </form>
        </div>

    </div>

</body>
</html>