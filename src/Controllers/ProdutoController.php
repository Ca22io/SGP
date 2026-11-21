<?php

namespace App\Controllers;

<<<<<<< HEAD
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
=======
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
>>>>>>> 2d54c2fb24edfac700422f7d3bbd069e5677bb02
        exit;
    }
}