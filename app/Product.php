<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function store() // rel 1:N
    {
        return $this->belongsTo(Store::class);
    }

    public function categories() // rel N:N // procura tabela pivot pela ordem alfabética dops models category_product
    {
        return $this->belongsToMany(Category::class);
        // return $this->belongsToMany(Category::class, 'products_categories'); /// nomeclatura fora de padrão para encontar a tabela pivot
    }
}

// 1:1 - Um pra um (Usuário e loja) hasOne e belongsTo
// 1:N - Um pra Muitos (Loja e Produtos) hasMany e belongsTo
// N:N - Muitos pra muitos (Produtos e categorias) | belongsToMany
