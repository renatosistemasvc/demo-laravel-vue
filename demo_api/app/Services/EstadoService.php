<?php

namespace App\Services;

use App\Models\Estado;

class EstadoService
{

	public function getAllPaginate($filtro = []){

        $res = Estado::where(function ($query) use (&$filtro) {

			if(isset($filtro['nome']) && !empty($filtro['nome']))
				$query->where('nome', 'ilike', "%" . $filtro['nome'] . "%");

		})->orderBy('id','desc')->paginate(10);

        return $res;
	}

	public function getAll(){

        $res = Estado::where('situacao', true)->get();
        return $res;
    }

	public function getById($id){

        $res = Estado::find($id);
        return $res;
    }

	public function store($array){

		$res = Estado::create($array);
		return $res;
    }

	public function update($array, $id){

		$res = Estado::find($id);
		return $res->update($array);
    }

	public function delete($id){

		$res = Estado::find($id);
		return $res->delete();
    }

}
