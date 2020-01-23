<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CepService;
use Auth;


class CepController extends Controller
{

    public function __construct(CepService $cepService){

        $this->cepService = $cepService;
    }

    public function getAllPaginate(Request $request){

        $filtro =  $request->all();

        $res = $this->cepService->getAllPaginate($filtro);
        return response()->json($res);
    }

    public function store(Request $request){

        $array =  $request->all();

        $res = $this->cepService->store($array);
        return response()->json($res);
    }

    public function getById($id){

        $res = $this->cepService->getById($id);
        return response()->json($res);
    }

    public function update(Request $request, $id){

        $array =  $request->all();

        $res = $this->cepService->update($array, $id);
        return response()->json($res);
    }

    public function delete($id){

        $res = $this->cepService->delete($id);
        return response()->json($res);
    }

    public function getEnderecoByCep($cep){

        $res = $this->cepService->getEnderecoByCep($cep);
        return response()->json(($res) ? $res : []);
    }

    public function getByFiltrosPaginate(Request $request){

        $filtros =  $request->all();

        $res = $this->cepService->getByFiltrosPaginate($filtros);
        return response()->json($res);
    }



}
