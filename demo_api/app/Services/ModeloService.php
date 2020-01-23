<?php

namespace App\Services;

use App\Models\Modelo;

class ModeloService
{

	public function getAllPaginate($filtro = []){

        $res = Modelo::where(function ($query) use (&$filtro) {
			
			if(isset($filtro['nome']) && !empty($filtro['nome']))
				$query->where('nome', 'ilike', "%" . $filtro['nome'] . "%");

		})->orderBy('id','desc')->paginate(10);

        return $res;
	}
	
	public function getAll(){

        $res = Modelo::get();
        return $res;        
    }
	
	public function getById($id){

        $res = Modelo::find($id);
        return $res;       
    }

	public function store($array){
		
		$res = Modelo::create($array);
		return $res;
    }

	public function update($array, $id){
		
		$res = Modelo::find($id);
		return $res->update($array);       
    }

	public function delete($id){
           
		$res = Modelo::find($id);
		return $res->delete();        
    }

}
