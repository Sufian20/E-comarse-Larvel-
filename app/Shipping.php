<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipping extends Model
{
    protected $fillable = [
        'payment_status'
    ];

    function user(){
        return $this->belongsTo('App\User', 'user_id');
       
 
     }
}
