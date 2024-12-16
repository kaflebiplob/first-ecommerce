<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    function user(){
        return $this->hasOne('App\Models\User','id','user_id');
     }
     function product(){
        return $this->hasOne('App\Models\Products','id','product_id');
     }
}
