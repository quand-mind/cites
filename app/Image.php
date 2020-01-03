<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
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
        return $this->belongsTo('App\Post');
    }
}
