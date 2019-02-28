<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public static  function incomplete(){
        return static::where(function ($query) {
            $query->where('id', '=', 2)->orWhere('id', '=', 3)->orWhere('id', '=', 4);
        });
    }
}
