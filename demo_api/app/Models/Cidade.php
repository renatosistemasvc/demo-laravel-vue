<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $table = 'cidades';

    protected $fillable = [

        'nome',
        'cod_censo',
        'situacao',
        'estado_id'
    ];

    protected $casts = [
        'situacao' => 'boolean'
    ];

    public function estado()
    {
        return $this->belongsTo('App\Models\Estado');
    }

    public function ceps()
    {
        return $this->hasMany('App\Models\Cep');
    }

}
