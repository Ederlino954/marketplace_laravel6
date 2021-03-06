<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Slug;

class Category extends Model
{
    use Slug;

    protected $fillable = ['name', 'description', 'slug'];

    public function products() // rel N:N // procura tabela pivot pela ordem alfabética dops models ((category_product_))
    {
        return $this->belongsToMany(Product::class);
    }
}

// return $this->belongsToMany(Product::class, 'products_categories'); /// nomeclatura fora de padrão para encontar a tabela ((pivot))

// 1:1 - Um pra um (Usuário e loja) hasOne e belongsTo
// 1:N - Um pra Muitos (Loja e Produtos) hasMany e belongsTo
// N:N - Muitos pra muitos (Produtos e categorias) | belongsToMany
