<?php
namespace App\Repositories;

use App\Repositories\VotacaoRepositoryInterface;
use App\Models\Pauta;
use App\Models\Votacao;

class VotacaoRepository implements VotacaoRepositoryInterface
{
    private $votacao;

    public function __construct(Votacao $votacao)
    {
        $this->votacao = $votacao;
    }
    
    public function find($id) 
    {
        return $this->votacao->find($id);
    }

    public function create($dados): Votacao
    {
        $votacao = $this->votacao->create($dados);
        return $votacao;
    }

    public function findByPauta(Pauta $pauta)
    {
        // $pauta->update($dados);
        // return $this->find($pauta->id);
    }
}