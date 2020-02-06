<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model
{
    use HasSlug;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'meta_description', 'meta_keywords', 'meta_robots',
        'content','is_subpage', 'is_onMenu', 'is_active', 'is_static'
    ];

    // Slug helper
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function lastModifiedBy () {
        return $this->belongsTo('App\User', 'lastModified_by');
    }

    public function createdBy () {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function getMainPage () {
        return $this->belongsTo('App\Page', 'main_page');
    }

    public function getSubpages () {
        return $this->hasMany('App\Page', 'main_page');
    }
}
