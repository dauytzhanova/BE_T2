<?php
/**
 * Created by IntelliJ IDEA.
 * User: dauytzhanovabotakoz
 * Date: 2/21/19
 * Time: 6:08 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdController extends Controller
{
    //
    public function index(){
        $products = \App\Products::all()->take(4);
        return view('posts.prod')->with('products',$products);
    }
}
