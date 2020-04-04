<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsideImage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image_order', 'src', 'active', 'name', 'url'
    ];

    public function disableImage () {
        $this->active = false;
        return;
    }

    public function enableImage () {
        $this->active = true;
        return;
    }

    public function setImageSrc ($name) {
        $this->src = '/images/' + $name;
    }
}
