<?php

namespace App;
use App\Category;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'categroy_id',
        'feature_image',
    ];


    function category(){
        return $this->belongsTo('App\category', 'category_id');
       
 
     }

     function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
