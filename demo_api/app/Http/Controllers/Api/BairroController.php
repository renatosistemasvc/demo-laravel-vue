<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BairroService;


class BairroController extends Controller
{

    public function __construct(BairroService $bairroService){

        $this->bairroService = $bairroService;
    }

    public function getAllPaginate(Request $request){

        $filtro =  $request->all();

        $res = $this->bairroService->getAllPaginate($filtro);
        return response()->json($res);
    }

    public function store(Request $request){

        $array =  $request->all();

        $res = $this->bairroService->store($array);
        return response()->json($res);
    }

    public function getById($id){

        $res = $this->bairroService->getById($id);
        return response()->json($res);
    }

    public function update(Request $request, $id){

        $array =  $request->all();

        $res = $this->bairroService->update($array, $id);
        return response()->json($res);
    }

    public function delete($id){

        $res = $this->bairroService->delete($id);
        return response()->json($res);
    }

    public function searchByNome(Request $request){

        $filtro =  $request->all();

        $res = $this->bairroService->searchByNome($filtro);
        return response()->json($res);
    }

}
