<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'meta_description', 'meta_keywords', 'meta_robots', 'content', 'date'
    ];

    public function author () {
        return $this->belongsTo('App\User');
    }

    public function getMainImage () {
        return $this->hasOne('App\Image');
    }

    public function getComments () {

        return $this->hasMany('App\Comment');
    }
}
