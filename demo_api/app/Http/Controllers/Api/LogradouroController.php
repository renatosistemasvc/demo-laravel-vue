<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LogradouroService;


class LogradouroController extends Controller
{

    public function __construct(LogradouroService $logradouroService){

        $this->logradouroService = $logradouroService;
    }

    public function getAllPaginate(Request $request){

        $filtro =  $request->all();

        $res = $this->logradouroService->getAllPaginate($filtro);
        return response()->json($res);
    }

    public function getAll(){

        $res = $this->logradouroService->getAll();
        return response()->json($res);
    }

    public function store(Request $request){

        $array =  $request->all();

        $res = $this->logradouroService->store($array);
        return response()->json($res);
    }

    public function getById($id){

        $res = $this->logradouroService->getById($id);
        return response()->json($res);
    }

    public function update(Request $request, $id){

        $array =  $request->all();

        $res = $this->logradouroService->update($array, $id);
        return response()->json($res);
    }

    public function delete($id){

        $res = $this->logradouroService->delete($id);
        return response()->json($res);
    }

    public function searchByNome(Request $request){

        $filtro =  $request->all();

        $res = $this->logradouroService->searchByNome($filtro);
        return response()->json($res);
    }

}
