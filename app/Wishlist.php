<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['product_quantity'];

    function product(){

        return $this->belongsTo('App\Product', 'product_id');
    }
    
}
