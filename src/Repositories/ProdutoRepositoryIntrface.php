<?php

interface ProdutoRepositoryInterface
{
    public function getAllProdutos();
    public function getProdutoById($id);
    public function createProduto($produto);
    public function updateProduto($id, $produto);
    public function deleteProduto($id);
}