<?php

namespace App\Services;

use App\Models\Cep;

class CepService
{

    public function getAllPaginate($filtro = []){

        $res = Cep::with(['bairro', 'logradouro', 'cidade'])->where(function ($query) use (&$filtro) {

			if(isset($filtro['cep']) && !empty($filtro['cep']))
				$query->where('cep', 'ilike', "%" . $filtro['cep'] . "%");

		})->orderBy('id','desc')->paginate(10);

        return $res;
	}

	public function getAll(){

        $res = Cep::get();
        return $res;
    }

	public function getById($id){

        $res = Cep::with(['bairro', 'logradouro', 'cidade.estado'])->find($id);
        return $res;
    }

	public function store($array){

        $array['cep'] = str_replace("-", "", $array['cep']);

		$res = Cep::create($array);
		return $res;
    }

	public function update($array, $id){

        $array['cep'] = str_replace("-", "", $array['cep']);

		$res = Cep::find($id);
		return $res->update($array);
    }

	public function delete($id){

		$res = Cep::find($id);
		return $res->delete();
    }

    public function getEnderecoByCep($cep){

        $res = Cep::with(['bairro', 'logradouro', 'cidade.estado'])
                ->where('cep', $cep)
                ->first();

        return $res;
    }

    public function getByFiltrosPaginate($filtros){

        $query = Cep::with(['bairro', 'logradouro', 'cidade.estado']);

        if(isset($filtros['bairro']) && !empty($filtros['bairro'])){

            $query->whereHas('bairro', function ($query) use (&$filtros) {
                $query->where('nome', 'ilike', "%" . $filtros['bairro'] . "%");
            });
        }

        if(isset($filtros['logradouro']) && !empty($filtros['logradouro'])){

            $query->whereHas('logradouro', function ($query) use (&$filtros) {
                $query->where('nome', 'ilike', "%" . $filtros['logradouro'] . "%");
            });
        }

        if(isset($filtros['cidade']) && !empty($filtros['cidade'])){

            $query->whereHas('cidade', function ($query) use (&$filtros) {
                $query->where('nome', 'ilike', "%" . $filtros['cidade'] . "%");
            });
        }

        if(isset($filtros['estado']) && !empty($filtros['estado'])){

            $query->whereHas('cidade.estado', function ($query) use (&$filtros) {
                $query->where('nome', 'ilike', "%" . $filtros['estado'] . "%");
            });
        }

        if(isset($filtros['cep']) && !empty($filtros['cep']))
            $query->where('cep', 'ilike', "%" . $filtros['cep'] . "%");

        $res = $query->paginate(9);

        return $res;
    }

    public function checkCepIsValido($cep){

        //DEIXA APENAS NÚMEROS
        $cep = preg_replace("/[^0-9]/", "", $cep);

        $res = Cep::where('cep', $cep)
                ->exists();

        return $res;
    }



}
