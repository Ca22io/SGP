<?php

namespace App\Repositories;

use App\Models\ProdutoModel;

interface ProdutoRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create(ProdutoModel $data);
    public function update($id, ProdutoModel $data);
    public function delete($id);
}

?>