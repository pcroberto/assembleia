<?php
 namespace App\Services;

use Illuminate\Http\Request;
use App\Models\VotacaoValidator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use App\Repositories\VotacaoRepositoryInterface;
use App\Repositories\PautaRepositoryInterface;

class VotacaoService
{
    private $votacaoRepository;

    private $pautaRepository;

    public function __construct(VotacaoRepositoryInterface $votacaoRepository, PautaRepositoryInterface $pautaRepository)
    {
        $this->votacaoRepository = $votacaoRepository;
        $this->pautaRepository = $pautaRepository;
    }

    public function new(Request $request)
    {
        $validator = Validator::make($request->all(), VotacaoValidator::RULES);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        try{
            $pauta = $this->pautaRepository->find($request->pauta_id);

            if (empty($pauta)) {
                return response()->json(["erro" => "Pauta não encontrada"], Response::HTTP_BAD_REQUEST);
            }

            if ($pauta->votacoes()->get()->count() > 0) {
                return response()->json(["erro" => "Esta pauta já fora votada"], Response::HTTP_BAD_REQUEST);   
            }
        
            $votacao = $this->votacaoRepository->create($request->all());
        } catch (QueryException $erro) {
            return response()->json(null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json($votacao, Response::HTTP_CREATED);
    }

    public function resultado($id)
    {
          
    }
}
