<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function store() // rel 1:N
    {
        return $this->belongsTo(Store::class);
    }
}

// 1:1 - Um pra um (Usuário e loja) hasOne e belongsTo
// 1:N - Um pra Muitos (Loja e Produtos) hasMany e belongsTo
// N:N - Muitos pra muitos (Produtos e categorias) | belongsToMany
