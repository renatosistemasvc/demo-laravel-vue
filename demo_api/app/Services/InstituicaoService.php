<?php

namespace App\Services;

use App\Models\Instituicao;

class InstituicaoService
{

	public function getAllPaginate($filtro = []){

        $res = Instituicao::where(function ($query) use (&$filtro) {
			
			if(isset($filtro['nome']) && !empty($filtro['nome']))
				$query->where('nome', 'ilike', "%" . $filtro['nome'] . "%");

		})->orderBy('id','desc')->paginate(10);

        return $res;
	}
	
	public function getAll(){

        $res = Instituicao::get();
        return $res;        
    }
	
	public function getById($id){

        $res = Instituicao::find($id);
        return $res;       
    }

	public function store($array){
		
		$res = Instituicao::create($array);
		return $res;
    }

	public function update($array, $id){
		
		$res = Instituicao::find($id);
		return $res->update($array);       
    }

	public function delete($id){
           
		$res = Instituicao::find($id);
		return $res->delete();        
    }

}
