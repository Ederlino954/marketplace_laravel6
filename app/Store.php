<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Notifications\StoreReceiveNewOrder;
use App\Traits\Slug;

class Store extends Model
{
    // protected $table = 'lojas'; // caso queira mudar o nome padrão da tabela

    use Slug;

    protected $fillable = ['name', 'description', 'phone', 'mobile_phone', 'slug', 'logo'];

    public function user() // rel 1:1
    {
        return $this->belongsTo(User::class);
        // return $this->belongsTo(User::class, 'usuario_id-exemplo'); // nomeclatura fora de padrão
    }

    public function products() // rel 1:N
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->belongsToMany(UserOrder::class, 'order_store', 'store_id', 'order_id');
    }

    public function notifyStoreOwners(array $storesId = [])
    {
        $stores = $this->whereIn('id', $storesId)->get();

        $stores->map(function($store) {
            return $store->user;
        })->each->notify(new StoreReceiveNewOrder());
    }
}


// 1:1 - Um pra um (Usuário e loja) hasOne e belongsTo
// 1:N - Um pra Muitos (Loja e Produtos) hasMany e belongsTo
// N:N - Muitos pra muitos (Produtos e categorias) | belongsToMany


// Store -> stores = procura por plural no banco de dados
// stores

// product -> products = procura por plural no banco de dados
