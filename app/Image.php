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
        'label', 'slug', 'alt_img', 'author_name', 'date', 'location'
    ];

    public function getNew () {
        return $this->belongsTo('App\New');
    }
}
