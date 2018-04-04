<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    public function index(){
        return Shop::paginate(5);
    }
    public function show(Shop $shop){
        return $shop;
    }
}
