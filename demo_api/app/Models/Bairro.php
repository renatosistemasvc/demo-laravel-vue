<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bairro extends Model
{
    protected $table = 'bairros';

    protected $fillable = [
        'nome',
        'situacao'
    ];

    protected $casts = [
        'situacao' => 'boolean'
    ];

    public function ceps()
    {
        return $this->hasMany('App\Models\Cep');
    }

}
