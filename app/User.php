<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'isActive', 'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function faqsMade () {
        return $this->hasMany('App\FAQ');
    }

    public function faqsAnswered () {
        return $this->hasMany('App\FAQ');
    }

    public function createdPages () {
        return $this->hasMany('App\Page');
    }

    public function lastModifiedPages () {
        return $this->hasMany('App\Pages');
    }
}
