<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
   function user(){
       return $this->belongsTo('App\User', 'user_id');
   }
}
