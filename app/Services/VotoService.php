<?php
namespace App\Services;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Repositories\VotacaoRepositoryInterface;
use App\Repositories\VotoRepositoryInterface;
use App\Models\VotoValidator;
use Illuminate\Support\Carbon;

class VotoService
{
     private $votoRepository;

     private $votacaoRepository;

     public function __construct(VotacaoRepositoryInterface $votacaoRepository, VotoRepositoryInterface $votoRepository)
     {
         $this->votacaoRepository = $votacaoRepository;
         $this->votoRepository = $votoRepository;
     }

     public function votar(Request $request)
     {
          $validator = Validator::make($request->all(), VotoValidator::RULES);

          if ($validator->fails()) {
              return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
          }

          try{
               $votacao = $this->votacaoRepository->find($request->votacao_id);
     
               if (empty($votacao)) {
                    return response()->json(["erro" => "Votação não encontrada"], Response::HTTP_BAD_REQUEST);
               }

               $tempoLimite = $votacao->created_at->addMinutes($votacao->minutos);

               if (Carbon::now()->gt($tempoLimite)) {
                    return response()->json(["erro" =>"Votação encerrada"], Response::HTTP_BAD_REQUEST);
               }

               foreach ($votacao->votos()->get() as $voto) {
                    if ($voto->associado == $request->associado) {
                         return response()->json(
                              ["erro" => "Este associado já votou para esta pauta"], 
                              Response::HTTP_BAD_REQUEST
                         );
                    }
               }
  
              $voto = $this->votoRepository->create($request->all());
          } catch (Exception $erro) {
              return response()->json(null, Response::HTTP_INTERNAL_SERVER_ERROR);
          }
  
          return response()->json($voto, Response::HTTP_CREATED);
     }
}