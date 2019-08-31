<?php
namespace App\Repositories;

use App\Models\Pauta;

interface PautaRepositoryInterface
{
    public function all();
    public function find($id);
    public function create($dados);
    public function update(Pauta $pauta, $dados);
    public function delete(Pauta $pauta);
}