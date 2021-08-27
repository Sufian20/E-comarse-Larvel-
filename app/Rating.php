<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Product;

class Rating extends Model
{
    protected $fillable = [ 'user_id', 'product_id', 'name', 'email', 'reviews', 'rating'  ];

    function product()
    {
        return $this->belongsTo(Product::class);
 
     }

}
