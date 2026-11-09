<?php

namespace App\Repositories;

use App\Config\Database;

class ProdutoRepository implements ProdutoRepositoryInterface
{
    private \mysqli $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function getAllProdutos()
    {
        $query = "SELECT * FROM produtos";
        $result = $this->conn->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProdutoById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function createProduto($produto)
    {
        $query = "INSERT INTO produtos (nome, descricao, preco) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssd", $produto['nome'], $produto['descricao'], $produto['preco']);
        return $stmt->execute();
    }

    public function updateProduto($id, $produto)
    {
        $query = "UPDATE produtos SET nome = ?, preco = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sdi", $produto['nome'], $produto['preco'], $id);
        return $stmt->execute();
    }

    public function deleteProduto($id)
    {
        $query = "DELETE FROM produtos WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}