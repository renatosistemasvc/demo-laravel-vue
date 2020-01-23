<?php

namespace App\Services;

use App\Models\Logradouro;

class LogradouroService
{

	public function getAllPaginate($filtro = []){

        $res = Logradouro::where(function ($query) use (&$filtro) {

			if(isset($filtro['nome']) && !empty($filtro['nome']))
				$query->where('nome', 'ilike', "%" . $filtro['nome'] . "%");

		})->orderBy('id','desc')->paginate(10);

        return $res;
    }

    public function getAll(){

        $res = Logradouro::where('situacao', true)->get();
        return $res;
    }

	public function searchByNome($filtro){

        $res = Logradouro::where('nome', 'ilike', "%" . $filtro['query'] . "%")
                ->where('situacao', true)->get();

        return $res;
    }

	public function getById($id){

        $res = Logradouro::find($id);
        return $res;
    }

	public function store($array){

		$res = Logradouro::create($array);
		return $res;
    }

	public function update($array, $id){

		$res = Logradouro::find($id);
		return $res->update($array);
    }

	public function delete($id){

		$res = Logradouro::find($id);
		return $res->delete();
    }

}
