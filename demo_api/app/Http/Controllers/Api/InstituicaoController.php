<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\InstituicaoService;
use Auth;


class InstituicaoController extends Controller
{

    public function __construct(InstituicaoService $instituicaoService){

        $this->instituicaoService = $instituicaoService;
    }

    public function getAllPaginate(Request $request){

        $filtro =  $request->all();

        $res = $this->instituicaoService->getAllPaginate($filtro);
        return response()->json($res);
    }

    public function getAll(){

        $res = $this->instituicaoService->getAll();
        return response()->json($res);
    }

    public function store(Request $request){

        $array =  $request->all();

        $res = $this->instituicaoService->store($array);
        return response()->json($res);
    }

    public function getById($id){

        $res = $this->instituicaoService->getById($id);
        return response()->json($res);
    }

    public function update(Request $request, $id){

        $array =  $request->all();

        $res = $this->instituicaoService->update($array, $id);
        return response()->json($res);
    }

    public function delete($id){

        $res = $this->instituicaoService->delete($id);
        return response()->json($res);
    }

}
