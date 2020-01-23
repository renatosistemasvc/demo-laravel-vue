<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CidadeService;
use Auth;

class CidadeController extends Controller
{

    public function __construct(CidadeService $cidadeService){

        $this->cidadeService = $cidadeService;
    }

    public function getAllPaginate(Request $request){

        $filtro =  $request->all();

        $res = $this->cidadeService->getAllPaginate($filtro);
        return response()->json($res);
    }

    public function getAll(){

        $res = $this->cidadeService->getAll();
        return response()->json($res);
    }

    public function store(Request $request){

        $array =  $request->all();

        $res = $this->cidadeService->store($array);
        return response()->json($res);
    }

    public function getById($id){

        $res = $this->cidadeService->getById($id);
        return response()->json($res);
    }

    public function update(Request $request, $id){

        $array =  $request->all();

        $res = $this->cidadeService->update($array, $id);
        return response()->json($res);
    }

    public function delete($id){

        $res = $this->cidadeService->delete($id);
        return response()->json($res);
    }

    public function getCidadeByNomePaginate(Request $request){

        $filtro =  $request->get('cidade');

        $res = $this->cidadeService->getCidadeByNomePaginate($filtro);
        return response()->json($res);
    }

    public function getAllCidadesByEstado($estado_id){

        $res = $this->cidadeService->getAllCidadesByEstado($estado_id);
        return response()->json(($res) ? $res : []);
    }

    public function searchByNome(Request $request){

        $filtro =  $request->all();

        $res = $this->cidadeService->searchByNome($filtro);
        return response()->json($res);
    }

}
