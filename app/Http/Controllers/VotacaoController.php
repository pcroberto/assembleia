<?php

namespace App\Http\Controllers;

use App\Services\VotoService;
use App\Services\VotacaoService;
use Illuminate\Http\Request;

class VotacaoController extends Controller
{
    private $votoService;

    private $votacaoService;

    public function __construct(VotoService $votoService, VotacaoService $votacaoService)
    {
        $this->votoService = $votoService;
        $this->votacaoService = $votacaoService;
    }

    public function new(Request $request)
    {
        return $this->votacaoService->new($request);
    }

    public function resultado(Request $request)
    {
        return $this->votacaoService->resultado($request);
    }
    
    public function votar(Request $request)
    {
        return $this->votoService->votar($request);
    }
}
