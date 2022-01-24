<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;

class Page extends Model
{

    use HasFactory;
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
                'source' => 'title',
                'onUpdate' => true
            ],
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
        'menu_order',
        'is_mainPage'
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
        return $this->belongsTo('App\Models\User', 'lastModified_by');
    }

    public function createdBy () {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function getMainPage () {
        return $this->belongsTo('App\Models\Page', 'main_page');
    }

    public function getSubpages () {
        return $this->hasMany('App\Models\Page', 'main_page');
    }
}
