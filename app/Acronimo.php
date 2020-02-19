<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acronimo extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'siglas', 'definition'
    ];
 
}
