<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\PautaRepositoryInterface;
use App\Models\PautaValidator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class PautaService
{
    private $pautaRepository;

    public function __construct(PautaRepositoryInterface $pautaRepository) 
    {
        $this->pautaRepository = $pautaRepository;
    }
    
    public function get($id)
    {
        return response()->json($this->pautaRepository->find($id), Response::HTTP_OK);
    }

    public function getAll()
    {
        return response()->json($this->pautaRepository->all(), Response::HTTP_OK);
    }

    public function new(Request $request)
    {
        $validator = Validator::make($request->all(), PautaValidator::RULES);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        try{
            $pauta = $this->pautaRepository->create($request->all());
        } catch (QueryException $erro) {
            return response()->json(null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json($pauta, Response::HTTP_CREATED);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), PautaValidator::RULES);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        
        try{
            $pauta = $this->pautaRepository->find($id);

            if (empty($pauta)) {
                throw new QueryException();
            }

            $this->pautaRepository->update($pauta, $request->all());
        } catch (QueryException $erro) {
            return response()->json(['erro' => 'Pauta não encontrada'], Response::HTTP_NOT_FOUND);
        } catch (Exception $erro) {
            return response()->json(null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json($this->pautaRepository->find($id), Response::HTTP_OK);
    }

    public function remove($id)
    {
        try{
            $pauta = $this->pautaRepository->find($id);

            if (empty($pauta)) {
                throw new QueryException();
            }

            $resultado = $this->pautaRepository->delete($pauta);
        } catch (QueryException $erro) {
            return response()->json(['erro' => 'Pauta não encontrada'], Response::HTTP_NOT_FOUND);
        } catch (Exception $erro) {
            return response()->json(null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json($resultado, Response::HTTP_OK);
    }
}
