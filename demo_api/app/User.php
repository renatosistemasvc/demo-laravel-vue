<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'imagem',
        'usuario', 
        'password',
        'situacao',
        'instituicao_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'usuario_verified_at' => 'datetime',
        'situacao' => 'boolean'
    ];

    public function instituicao()
    {
        return $this->belongsTo('App\Models\Instituicao');
    }

    public function findForPassport($username)
    {

        return $this->where('situacao', true)->where('usuario', $username)->first();
    }

}
