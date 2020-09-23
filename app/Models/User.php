<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'is_active', 'photo', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questionsAnswered()
    {
        return $this->hasMany('App\Models\Question');
    }

    public function createdPages()
    {
        return $this->hasMany('App\Models\Page');
    }

    public function lastModifiedPages()
    {
        return $this->hasMany('App\Models\Page');
    }

    public function createdPosts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function createdSurveys()
    {
        return $this->hasMany('App\Models\Survey');
    }

    // methods
    public function isWriter()
    {
        return $this->role == 'writer';
    }
}
