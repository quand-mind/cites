<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeaderImage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image_order', 'src', 'active'
    ];

    public function disableImage () {
        $this->active = false;
        return;
    }

    public function enableImage () {
        $this->active = true;
        return;
    }

    public function setImageSrc ($src) {
        $this->src = $src;
    }
}