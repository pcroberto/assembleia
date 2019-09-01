<?php
namespace App\Repositories;

use App\Models\Pauta;

interface VotoRepositoryInterface
{
    public function create($dados);
}