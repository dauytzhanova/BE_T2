<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //
    public function index(){
        $orders = \App\Orders::all();
        return view('posts.orders',compact('orders'));
    }
}
