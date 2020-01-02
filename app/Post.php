<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Post extends Model
{
    use HasSlug;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'meta_description', 'meta_keywords', 'meta_robots', 'content', 'publish_date'
    ];

    // Slug helper
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    // Relationships

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
