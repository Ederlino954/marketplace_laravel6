<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Slug;

class Product extends Model
{
    use Slug;

    // protected $fillable = ['id','name', 'description', 'body', 'price', 'slug'];
    protected $fillable = ['name', 'description', 'body', 'price', 'slug'];

    // Accessor = full_name -> getFullNameAttribute = exemplo de nomeação
    public function getThumbAttribute() // Accessor
    {
        return $this->photos->first()->image;
    }


    // Relations

    public function store() // rel 1:N
    {
        return $this->belongsTo(Store::class);
    }

    public function categories() // rel N:N // procura tabela pivot pela ordem alfabética dops models category_product
    {
        return $this->belongsToMany(Category::class);
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }
}

// return $this->belongsToMany(Category::class, 'products_categories'); /// nomeclatura fora de padrão para encontar a tabela pivot

// 1:1 - Um pra um (Usuário e loja) hasOne e belongsTo
// 1:N - Um pra Muitos (Loja e Produtos) hasMany e belongsTo
// N:N - Muitos pra muitos (Produtos e categorias) | belongsToMany
