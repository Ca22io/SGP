<?php

namespace App\Repositories;

<<<<<<< HEAD
use App\Models\ProdutoModel;
use PDO;

class ProdutoRepository implements ProdutoRepositoryInterface
{
    private PDO $database;

    public function __construct(PDO $database)
    {
        $this->database = $database;
    }

    public function getAll(): array
    {
        $statement = $this->database->query("SELECT * FROM produtos ORDER BY id DESC");
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id): ?ProdutoModel
    {
        $stmt = $this->database->prepare("SELECT * FROM produtos WHERE id = :ID");
        $stmt->bindValue(':ID', $id, PDO::PARAM_INT);
        $stmt->execute();

        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$produto) {
            return null;
        }

        return new ProdutoModel(
            $produto['nome'],
            $produto['descricao'],
            (float) $produto['preco'],
            (int) $produto['id']
        );
    }

    public function create(ProdutoModel $data): ProdutoModel
    {
        $stmt = $this->database->prepare(
            "INSERT INTO produtos (nome, descricao, preco) VALUES (:NOME, :DESCRICAO, :PRECO)"
        );

        $stmt->bindValue(':NOME', $data->getNome());
        $stmt->bindValue(':DESCRICAO', $data->getDescricao());
        $stmt->bindValue(':PRECO', $data->getPreco());

        try {
            $stmt->execute();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao criar produto: " . $e->getMessage());
        }

        return new ProdutoModel(
            $data->getNome(),
            $data->getDescricao(),
            $data->getPreco(),
            (int) $this->database->lastInsertId()
        );
    }

    public function update($id, ProdutoModel $data): ProdutoModel
    {
        $stmt = $this->database->prepare(
            "UPDATE produtos SET nome = :NOME, descricao = :DESCRICAO, preco = :PRECO WHERE id = :ID"
        );

        $stmt->bindValue(':NOME', $data->getNome());
        $stmt->bindValue(':DESCRICAO', $data->getDescricao());
        $stmt->bindValue(':PRECO', $data->getPreco());
        $stmt->bindValue(':ID', $id, PDO::PARAM_INT);

        try {
            $stmt->execute();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar produto: " . $e->getMessage());
        }

        return new ProdutoModel(
            $data->getNome(),
            $data->getDescricao(),
            $data->getPreco(),
            (int) $id
        );
    }

    public function delete($id): bool
    {
        $stmt = $this->database->prepare("DELETE FROM produtos WHERE id = :ID");
        $stmt->bindValue(':ID', $id, PDO::PARAM_INT);

        try {
            return $stmt->execute();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar produto: " . $e->getMessage());
        }
=======
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
>>>>>>> 2d54c2fb24edfac700422f7d3bbd069e5677bb02
    }
}