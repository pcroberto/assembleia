<?php
namespace App\Repositories;

use App\Repositories\VotacaoRepositoryInterface;
use App\Models\Pauta;
use App\Models\Voto;

class VotoRepository implements VotoRepositoryInterface
{
    private $voto;

    public function __construct(Voto $voto)
    {
        $this->voto = $voto;
    }

    public function create($dados): Voto
    {
        $voto = $this->voto->create($dados);
        return $voto;
    }
}