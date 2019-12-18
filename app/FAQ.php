<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class FAQ extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'answer', 'favorite'
    ];



    public function creator() {
        return $this->belongsTo('App\User');
    }

    public function responser() {
        return $this->belongsTo('App\User');
    }

    public function categories() {
        return $this->belongsToMany('App\FAQCategory');
    }
}
