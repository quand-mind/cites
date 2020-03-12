<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
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
