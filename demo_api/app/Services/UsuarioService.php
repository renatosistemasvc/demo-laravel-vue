<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\User;
use Exception;
use Auth;

class UsuarioService
{

	public function getUsuarioLogado($usuario_id){

		$res = User::with(['instituicao'])->find($usuario_id);
		return $res;
		
	}

    public function getAllPaginate($filtro = []){

        $res = User::where(function ($query) use (&$filtro) {
			
			if(isset($filtro['name']) && !empty($filtro['name']))
				$query->where('name', 'ilike', "%" . $filtro['name'] . "%");

		})->orderBy('id','desc')->paginate(10);

        return $res;
	}

	public function verificaUsuario($usuario){

		$res = User::where('usuario', $usuario)->exists();
		return $res;
	}
	
	public function store($array){

		DB::beginTransaction();

         try {

			$t = $this->verificaUsuario($array['usuario']);
			 
			if($t){

				DB::rollback();
				return [ 'throw' => ['type' => 'warning', 'msg' => 'O usuario informado já está cadastrado.']];
			}

			if(strlen($array['password']) < 6 || strlen($array['password']) > 8){

				DB::rollback();
				return [ 'throw' => ['type' => 'warning', 'msg' => 'A senha deve ter mínimo 6 e máximo 8 caracteres']];
			}

			if($array['password'] != $array['password_confirmation']){
    
				DB::rollback();
				return [ 'throw' => ['type' => 'warning', 'msg' => 'As senhas e a confirmação de senha não são iguais.']];
			}

			$array['password'] = bcrypt($array['password']);
			
			$res = User::create($array);		
			
			DB::commit();
            return $res; 
		
		} catch (\Exception $e) {
			DB::rollback();
			throw new Exception($e->getMessage());
		}
    }


	public function getById($id){

		$res = User::with(['instituicao'])->find($id);
        return $res;       
	}
	
	public function update($array, $id){
		
		DB::beginTransaction();

         try {

			$res = User::find($id);


			if(isset($array['usuario']) && !empty($array['usuario'])){

				$t = $this->verificaUsuario($array['usuario']);
			 
				if($t){

					DB::rollback();
					return [ 'throw' => ['type' => 'warning', 'msg' => 'O usuario informado já está cadastrado.']];
				}

			}else{

				unset($array['usuario']);
			}
			
			if(isset($array['password']) && !empty($array['password'])){

				if(strlen($array['password']) < 6 || strlen($array['password']) > 8){

					DB::rollback();
					return [ 'throw' => ['type' => 'warning', 'msg' => 'A senha deve ter mínimo 6 e máximo 8 caracteres']];
				}

				if($array['password'] != $array['password_confirmation']){
    
					DB::rollback();
					return [ 'throw' => ['type' => 'warning', 'msg' => 'As senhas e a confirmação de senha não são iguais.']];
				}
	
				$array['password'] = bcrypt($array['password']);

			}else{

				unset($array['password']);
			}			
		
			$res->update($array);		
			
			DB::commit();
            return $res; 
		
		} catch (\Exception $e) {
			DB::rollback();
			throw new Exception($e->getMessage());
		}


	}
	
	public function delete($id){
           
		$res = User::find($id);
		return $res->delete();        
    }

	   

}
