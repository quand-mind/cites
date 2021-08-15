<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Model
{
    
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'dni', 
        'nationality', 
        'domicile', 
        'address', 
        'phone', 
        'mobile', 
        'fax', 
        'is_active', 
        'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    /*protected $hidden = [
        'password', 'remember_token',
    ];*/

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
    
    public function officials()
    {
        return $this->hasMany(Official::class);
    }
    public function clients()
    {
        return $this->hasMany(Client::class);
    }
    // methods
    public function isWriter()
    {
        return $this->role == 'writer';
    }
    public function isPersonLegal()
    {
        return $this->role == 'perosna_juridica';
    }
    public function isNaturalPerson()
    {
        return $this->role == 'perosna_natural';
    }
}
