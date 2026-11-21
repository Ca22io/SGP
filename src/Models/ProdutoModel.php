<?php

namespace App\Models;

class ProdutoModel
{
    private ?int $id;
    private string $nome;
    private string $descricao;
    private float $preco;

    public function __construct(string $nome, string $descricao, float $preco, ?int $id = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->preco = $preco;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getPreco(): float
    {
        return $this->preco;
    }
}