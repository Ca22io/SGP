<?php

class Produto {
    private $id;
    private $nome;
    private $preco;
    private $descricao;

    public function __construct($id, $nome, $preco, $descricao) {
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->descricao = $descricao;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getDescricao() {
        return $this->descricao;
    }
}