<?php
 namespace App\Services;

use Illuminate\Http\Request;
use App\Models\VotacaoValidator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use App\Repositories\VotacaoRepositoryInterface;
use App\Repositories\PautaRepositoryInterface;
use Illuminate\Support\Carbon;

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

            if ($pauta->votacao()->get()->count() > 0) {
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
        $pauta = $this->pautaRepository->find($id);

        if (empty($pauta)) {
            return response()->json(["erro" => "Pauta não encontrada"], Response::HTTP_BAD_REQUEST);
        }

        $votacao = $pauta->votacao()->get();

        if ($votacao->count() == 0 ) {
            return response()->json(["erro" => "Esta pauta ainda não fora votada."], Response::HTTP_BAD_REQUEST);
        }

        $votacao = $votacao->get(0);

        $tempoLimite = $votacao->created_at->addMinutes($votacao->minutos);

        if (Carbon::now()->lt($tempoLimite)) {
            return response()->json(
                ["erro" => "A votação ainda está em andamento. Aguarde o seu término para saber o resultado"], 
                Response::HTTP_BAD_REQUEST
            );
        }

        $votos = $votacao->votos()->get();
        
        if ($votos->count() == 0) {
            return response()->json(["erro" => "Votação sem nenhum voto computado."], Response::HTTP_OK);
        }

        $resultado = [
            "total" => $votos->count(),
            "sim" => 0,
            "nao" => 0,
            "votos" => $votos
        ];

        foreach ($votos as $voto) {
            if ($voto->voto) {
                $resultado['sim']++;
                continue;
            }

            $resultado['nao']++;
        }

        return response()->json($resultado, Response::HTTP_OK);
    }
}

