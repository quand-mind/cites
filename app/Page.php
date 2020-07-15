<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Page extends Model
{

    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'meta_description', 'meta_keywords', 'meta_robots',
        'content','is_subpage', 'is_onMenu', 'is_active', 'is_static',
        'menu_order'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    // protected static function booted()
    // {
        
    // }

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
