<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PautaService;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class PautaController extends Controller
{
    private $pautaService;

    public function __construct(PautaService $pautaService) 
    {
        $this->pautaService = $pautaService;
    }
    
    public function get($id)
    {
        return $this->pautaService->get($id);
    }

    public function getAll()
    {
        return $this->pautaService->getAll();
    }

    public function new(Request $request)
    {
        return $this->pautaService->new($request);
    }

    public function update($id, Request $request)
    {
        return $this->pautaService->update($id, $request);
    }

    public function remove($id)
    {
        return $this->pautaService->remove($id);
    }
}
