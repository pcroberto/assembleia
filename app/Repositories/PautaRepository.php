<?php
namespace App\Repositories;

use App\Repositories\PautaRepositoryInterface;
use App\Models\Pauta;

class PautaRepository implements PautaRepositoryInterface
{
    private $pauta;

    public function __construct(Pauta $pauta)
    {
        $this->pauta = $pauta;
    }

    public function all()
    {
        return $this->pauta->all();
    }
    
    public function find($id) 
    {
        return $this->pauta->find($id);
    }

    public function create($dados): Pauta
    {
        $pauta = $this->pauta->create($dados);
        return $pauta;
    }

    public function update(Pauta $pauta, $dados)
    {
        $pauta->update($dados);
        return $this->find($pauta->id);
    }

    public function delete(Pauta $pauta)
    {
        return $pauta->delete();
    }
}