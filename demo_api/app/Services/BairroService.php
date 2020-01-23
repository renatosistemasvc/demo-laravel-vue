<?php

namespace App\Services;

use App\Models\Bairro;

class BairroService
{

	public function getAllPaginate($filtro = []){

        $res = Bairro::where(function ($query) use (&$filtro) {

			if(isset($filtro['nome']) && !empty($filtro['nome']))
				$query->where('nome', 'ilike', "%" . $filtro['nome'] . "%");

		})->orderBy('id','desc')->paginate(10);

        return $res;
	}

	public function getAll(){

        $res = Bairro::get();
        return $res;
    }

	public function getById($id){

        $res = Bairro::find($id);
        return $res;
    }

	public function store($array){

		$res = Bairro::create($array);
		return $res;
    }

	public function update($array, $id){

		$res = Bairro::find($id);
		return $res->update($array);
    }

	public function delete($id){

		$res = Bairro::find($id);
		return $res->delete();
    }

    public function searchByNome($filtro){

        $res = Bairro::where('nome', 'ilike', "%" . $filtro['query'] . "%")
                ->where('situacao', true)->get();

        return $res;
    }

}
