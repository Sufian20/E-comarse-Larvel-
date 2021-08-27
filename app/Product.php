<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Rating;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_name' ,
        'slug',
       'categroy_id',
       'subcategroy_id',
       'product_price',
       'product_quantity',
       'product_summary',
       'product_description',
       'product_section_status',
       'product_thumbnil',
    ];

   function category(){
       return $this->belongsTo('App\Category', 'categroy_id');
      

    }

    function subcategory(){
        return $this->belongsTo('App\SubCategory', 'subcategroy_id');
       
 
     }

     function cart(){

        return $this->hasMany('App\Cart', 'product_id');
     }

     function billing(){
      return $this->hasMany('App\Billing', 'product_id');
       // return $this->hasMany(Billing::class);
     }

     function rating(){

      return $this->hasMany(Rating::class);
   }

   function wishlist(){

      return $this->hasMany('App\Cart', 'product_id');
   }

}
