<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\UserOrder;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    private $order;

    public function __construct(UserOrder $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        // $orders = auth()->user()->store->orders()->paginate(15);

        $order = auth()->user();

        if(!$order->store()->exists()) {
            flash('É preciso cria uma loja para ter acesso a Meus pedidos!
            Meus Pedidos inacessíveis no momento!')->warning();
            return redirect()->route('admin.stores.index');
        }

        $orders = $order->store->orders()->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }
}
