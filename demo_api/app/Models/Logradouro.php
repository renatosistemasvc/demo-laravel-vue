<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logradouro extends Model
{
    protected $table = 'logradouros';

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
