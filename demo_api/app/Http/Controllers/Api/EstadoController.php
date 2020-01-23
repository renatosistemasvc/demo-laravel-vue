<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\EstadoService;
use Auth;


class EstadoController extends Controller
{

    public function __construct(EstadoService $estadoService){

        $this->estadoService = $estadoService;
    }

    public function getAllPaginate(Request $request){

        $filtro =  $request->all();

        $res = $this->estadoService->getAllPaginate($filtro);
        return response()->json($res);
    }

    public function getAll(){

        $res = $this->estadoService->getAll();
        return response()->json($res);
    }

    public function store(Request $request){

        $array =  $request->all();

        $res = $this->estadoService->store($array);
        return response()->json($res);
    }

    public function getById($id){

        $res = $this->estadoService->getById($id);
        return response()->json($res);
    }

    public function update(Request $request, $id){

        $array =  $request->all();

        $res = $this->estadoService->update($array, $id);
        return response()->json($res);
    }

    public function delete($id){

        $res = $this->estadoService->delete($id);
        return response()->json($res);
    }

}
