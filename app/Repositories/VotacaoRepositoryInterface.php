<?php
namespace App\Repositories;

use App\Models\Pauta;

interface VotacaoRepositoryInterface
{
    public function find($id);
    public function create($dados);
    public function findByPauta(Pauta $pauta);
}