<?php

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
        
        $query = "SELECT * FROM produtos WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function createProduto($produto)
    {
        $query = "INSERT INTO produtos (nome, preco) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sd", $produto['nome'], PDO::PARAM_STR, $produto['preco'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateProduto($id, $produto)
    {
        $query = "UPDATE produtos SET nome = ?, preco = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sdi", $produto['nome'], PDO::PARAM_STR, $produto['preco'], PDO::PARAM_STR, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteProduto($id)
    {
        $query = "DELETE FROM produtos WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}