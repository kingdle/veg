<?php

namespace App\Http\Controllers;


use App\Http\Resources\OrderCollection;
use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(9);
        return new OrderCollection($orders);
    }

    public function show()
    {

    }
}
