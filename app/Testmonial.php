<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testmonial extends Model
{
    protected $fillable = [
        'clint_say', 'clint_name', 'clint_title', 'clint_image',
    ];
}
