<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function index(){
        $prods = \App\Products::all()->take(3);
        return view("posts.index",compact('prods'));
    }

    public function orders(){
        return view("posts.orders");
    }
    public function basket(){
        $basket=session('basket');
        $prod=array();
        if(isset($basket)){
            while($element = current($basket)) {
                $prod[key($basket)] = \App\Products::find(key($basket));
                next($basket);
            }
        }
        return view("posts.basket",compact('basket'),compact('prod'));
    }
    public function admin(){
        return view("posts.admin");
    }

    public function login(){
        return view("auth.login");
    }
    public function reg(){
        return view("auth.register");
    }
}
