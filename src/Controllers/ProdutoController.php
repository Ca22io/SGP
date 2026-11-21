<?php

namespace App\Controllers;

use App\Repositories\ProdutoRepositoryInterface;
use App\Models\ProdutoModel;

class ProdutoController
{
    private ProdutoRepositoryInterface $produtoRepository;

    public function __construct(ProdutoRepositoryInterface $produtoRepository)
    {
        $this->produtoRepository = $produtoRepository;
    }

    public function index() {
        $produtos = $this->produtoRepository->getAll();
        // Certifique-se de que o arquivo na pasta views tenha exatamente esse nome (Index.php ou index.php)
        require_once __DIR__ . '/../../views/Index.php';
    }

    public function create() {
        require_once __DIR__ . '/../../views/createproduto.php';
    }

    public function salve_create() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $descricao = trim($_POST['descricao'] ?? '');
            $precoRaw = str_replace(',', '.', trim($_POST['preco'] ?? ''));
            $preco = filter_var($precoRaw, FILTER_VALIDATE_FLOAT);

            if (!empty($nome) && !empty($descricao) && $preco !== false && $preco >= 0) {
                $produto = new ProdutoModel($nome, $descricao, $preco);
                $this->produtoRepository->create($produto);
            }

            header("Location: index.php");
            exit;
        }
    }

    public function update(int $id) {
        $produto = $this->produtoRepository->getById($id);
        require_once __DIR__ . '/../../views/updateproduto.php';
    }

    public function save_update(int $id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $descricao = trim($_POST['descricao'] ?? '');
            $preco = filter_var($_POST['preco'] ?? 0, FILTER_VALIDATE_FLOAT);

            if (!empty($nome) && !empty($descricao) && $preco !== false && $preco >= 0) {
                // O ID vai no construtor do Model para o repository atualizar o registro certo
                $produto = new ProdutoModel($nome, $descricao, $preco, $id);
                $this->produtoRepository->update($id, $produto);
            }

            header("Location: index.php");
            exit;
        }
    }

    public function delete(int $id) {
        $produto = $this->produtoRepository->getById($id);
        require_once __DIR__ . '/../../views/deleteproduto.php';
    }

    public function save_delete(int $id) {
        $this->produtoRepository->delete($id);
        header("Location: index.php");
        exit;
    }
}