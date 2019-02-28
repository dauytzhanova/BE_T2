<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    public static  function find($id){
        return static::where('id',$id)->get();
    }

}
