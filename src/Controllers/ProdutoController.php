<?php

namespace App\Controllers;

use App\Repositories\ProdutoRepository;

class ProdutoController
{
    private ProdutoRepository $produtoRepository;

    public function __construct()
    {
        $this->produtoRepository = new ProdutoRepository();
    }

    public function index()
    {
        return $this->produtoRepository->getAllProdutos();
    }

    public function create()
    {
        require __DIR__ . '/../../public/create.php';
    }

    public function store($data)
    {
        $produto = [
            'nome' => trim($data['nome'] ?? ''),
            'descricao' => trim($data['descricao'] ?? ''),
            'preco' => (float) ($data['preco'] ?? 0),
        ];

        if ($produto['nome'] === '' || $produto['descricao'] === '' || $produto['preco'] <= 0) {
            http_response_code(422);
            echo 'Nome, descrição e preço válido são obrigatórios.';
            return;
        }

        $this->produtoRepository->createProduto($produto);
        header('Location: /produtos');
        exit;
    }

    public function edit($id)
    {
        $produto = $this->produtoRepository->getProdutoById($id);
        if ($produto === null) {
            http_response_code(404);
            echo 'Produto não encontrado.';
            return;
        }

        require __DIR__ . '/../../public/edit.php';
    }

    public function update($id, $data)
    {
        $produto = [
            'nome' => trim($data['nome'] ?? ''),
            'preco' => (float) ($data['preco'] ?? 0),
        ];

        if ($produto['nome'] === '' || $produto['preco'] <= 0) {
            http_response_code(422);
            echo 'Nome e preço válido são obrigatórios.';
            return;
        }

        $this->produtoRepository->updateProduto($id, $produto);
        header('Location: /produtos');
        exit;
    }

    public function delete($id)
    {
        $this->produtoRepository->deleteProduto($id);
        header('Location: /produtos');
        exit;
    }
}