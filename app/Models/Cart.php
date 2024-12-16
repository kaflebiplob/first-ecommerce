<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'quantity'];
    function product()
    {
        return $this->hasOne('App\Models\Products', 'id', 'product_id');
    }
    function user()
    {
        return $this->hasOne('App\models\User', 'id', 'user_id');
    }
}
