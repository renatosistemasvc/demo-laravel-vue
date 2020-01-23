<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ModeloService;


class ModeloController extends Controller
{

    public function __construct(ModeloService $modeloService){

        $this->modeloService = $modeloService;
    }

    public function getAllPaginate(Request $request){

        $filtro =  $request->all();

        $res = $this->modeloService->getAllPaginate($filtro);
        return response()->json($res);
    }

    public function getAll(Request $request){

        $filtro =  $request->all();

        $res = $this->modeloService->getAll($filtro);
        return response()->json($res);
    }

    public function store(Request $request){

        $array =  $request->all();

        $res = $this->modeloService->store($array);
        return response()->json($res);
    }

    public function getById($id){

        $res = $this->modeloService->getById($id);
        return response()->json($res);
    }

    public function update(Request $request, $id){

        $array =  $request->all();

        $res = $this->modeloService->update($array, $id);
        return response()->json($res);
    }

    public function delete($id){

        $res = $this->modeloService->delete($id);
        return response()->json($res);
    }

}
