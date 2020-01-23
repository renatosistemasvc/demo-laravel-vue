<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UsuarioService;
use Auth;

use Illuminate\Http\Request;


class UsuarioController extends Controller
{

    public function __construct(UsuarioService $usuarioService){

        $this->usuarioService = $usuarioService;
    }

    public function getUsuarioLogado(){

        $usuario_id = Auth::guard('api')->user()->id;
        $res = $this->usuarioService->getUsuarioLogado($usuario_id);
        return response()->json($res);
    }
    
    public function getAllPaginate(Request $request){

        $filtro =  $request->all();
        
        $res = $this->usuarioService->getAllPaginate($filtro);
        return response()->json($res);
    }

    public function store(Request $request){

        $array =  $request->all();

        $res = $this->usuarioService->store($array);
        return response()->json($res);    
    }

    public function getById($id){
        
        $res = $this->usuarioService->getById($id);
        return response()->json($res);
    }
    
    public function update(Request $request, $id){

        $array =  $request->all();

        $res = $this->usuarioService->update($array, $id);
        return response()->json($res); 
    }

    public function delete($id){
        
        $res = $this->usuarioService->delete($id);
        return response()->json($res); 
    }

    
}
