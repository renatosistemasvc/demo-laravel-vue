<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{

    protected $table = 'estados';

    protected $fillable = [
        'nome',
        'uf',
        'situacao'
    ];

    protected $casts = [
        'situacao' => 'boolean'
    ];

    public function cidades()
    {
        return $this->hasMany('App\Models\Cidade');
    }


}
