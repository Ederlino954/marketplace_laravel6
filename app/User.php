<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', // exemplo'name', // campo oculto
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [ // converte um valor com base nas colunas
        'email_verified_at' => 'datetime',
        // 'name' => 'boolean', // exemplo
    ];

    public function store() // rel 1:1
    {
        return $this->hasOne(Store::class);
        // return $this->hasOne(Store::class, 'usuario_id-exemplo'); // nomeclatura fora de padrão
    }

    public function orders()
    {
        return $this->hasMany(UserOrder::class);
    }

    // public function routeNotificationForNexmo($notification)
    // {
    //     $storeMobilePhoneNumber = trim(str_replace(['(', ')', ' ', '-'], '',  $this->store->mobile_phone));
    //     return '55' . $storeMobilePhoneNumber;
    // }
}


// 1:1 - Um pra um (Usuário e loja) hasOne e belongsTo
// 1:N - Um pra Muitos (Loja e Produtos) hasMany e belongsTo
// N:N - Muitos pra muitos (Produtos e categorias) | belongsToMany

