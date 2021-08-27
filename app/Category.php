<?php

namespace App;
use App\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

use SoftDeletes;

  protected $fillable = [

    'category_name'
  ];

  function product(){

      return $this->hasMany('App\Product', 'categroy_id');
  }

  function blog(){

    return $this->hasMany('App\Blog', 'category_id');
  }

}
