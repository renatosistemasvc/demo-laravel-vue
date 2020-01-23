<?php

namespace App\Services;

use App\Models\Cidade;

class CidadeService
{

	public function getAllPaginate($filtro = []){

        $res = Cidade::with(['estado'])->where(function ($query) use (&$filtro) {

			if(isset($filtro['nome']) && !empty($filtro['nome']))
				$query->where('nome', 'ilike', "%" . $filtro['nome'] . "%");

		})->orderBy('id','desc')->paginate(10);

        return $res;
	}

	public function getAll(){

        $res = Cidade::get();
        return $res;
    }

	public function getById($id){

        $res = Cidade::find($id);
        return $res;
    }

	public function store($array){

		$res = Cidade::create($array);
		return $res;
    }

	public function update($array, $id){

		$res = Cidade::find($id);
		return $res->update($array);
    }

	public function delete($id){

		$res = Cidade::find($id);
		return $res->delete();
    }

    public function getCidadeByNomePaginate($nome){

        $query = Cidade::with(['estado'])->where('nome', 'ilike', "%" . $nome . "%");

		$res = $query->paginate(9);

        return $res;
    }

    public function getAllCidadesByEstado($estado_id){

        $res = Cidade::where('estado_id', $estado_id)->where('situacao', true)->get();
        return $res;
    }

    public function searchByNome($filtro){

        $res = Cidade::with(['estado'])->where('nome', 'ilike', "%" . $filtro['query'] . "%")
                ->where('situacao', true)->get();

        $formated = [];
        foreach($res as $val){

            $formated [] = ['id' => $val['id'], 'nome' => $val['nome'] . ' - ' . (isset($val['estado']['nome']) ? $val['estado']['nome'] : '')];
        }

        return $formated;
    }

}
