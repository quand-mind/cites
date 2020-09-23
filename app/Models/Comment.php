<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content'
    ];

    public function getUser () {
        return $this->belongsTo('App\Models\User');
    }

    public function getNew () {
        return $this->belongsTo('App\Models\Post');
    }
}
