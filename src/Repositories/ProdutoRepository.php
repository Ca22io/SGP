<?php

namespace App\Repositories;

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
    }
}