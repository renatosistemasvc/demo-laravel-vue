<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cep extends Model
{
    protected $table = 'ceps';

    protected $fillable = [
        'cep',
        'situacao',
        'bairro_id',
        'logradouro_id',
        'cidade_id'

    ];

    protected $casts = [
        'situacao' => 'boolean'
    ];

    public function bairro()
    {
        return $this->belongsTo('App\Models\Bairro');
    }

    public function logradouro()
    {
        return $this->belongsTo('App\Models\Logradouro');
    }

    public function cidade()
    {
        return $this->belongsTo('App\Models\Cidade');
    }


}
