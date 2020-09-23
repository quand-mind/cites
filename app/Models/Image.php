<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'slug', 'alt_img', 'author', 'date', 'location'
    ];

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
}
