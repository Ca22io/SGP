<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de Gerenciamento de Produtos">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/style.css">
    <title>Adicionar produto | SGP</title>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
    <main class="mx-auto max-w-2xl px-6 py-10 lg:py-16">
        <a href="/produtos" class="text-sm font-medium text-cyan-400 transition hover:text-cyan-300">← Voltar para produtos</a>
        <div class="mt-8 rounded-2xl border border-slate-800 bg-slate-900 p-6 shadow-2xl shadow-black/20 sm:p-8">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-cyan-400">Novo cadastro</p>
            <h1 class="mt-3 text-3xl font-bold text-white">Adicionar produto</h1>
            <p class="mt-2 text-slate-400">Preencha os dados abaixo para cadastrar um produto.</p>

            <form class="mt-8 space-y-6" action="/produtos/store" method="POST">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-300" for="nome">Nome</label>
                    <input class="form-input" type="text" id="nome" name="nome" placeholder="Ex.: Notebook Pro" required>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-300" for="descricao">Descrição</label>
                    <textarea class="form-input min-h-32 resize-y" id="descricao" name="descricao" placeholder="Descreva o produto" required></textarea>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-300" for="preco">Preço</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500">R$</span>
                        <input class="form-input pl-12" type="number" id="preco" name="preco" min="0.01" step="0.01" placeholder="0,00" required>
                    </div>
                </div>
                <button class="w-full rounded-xl bg-cyan-400 px-5 py-3 font-semibold text-slate-950 transition hover:bg-cyan-300 focus:outline-none focus:ring-2 focus:ring-cyan-300 focus:ring-offset-2 focus:ring-offset-slate-900" type="submit">Adicionar produto</button>
            </form>
        </div>
    </main>
</body>
</html>