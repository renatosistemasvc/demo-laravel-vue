<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{

    protected $table = 'instituicoes';

    protected $fillable = [
        'nome',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'telefone',
        'celular'
    ];

    public function usuarios()
    {
        return $this->hasMany('App\User');
    }

}
