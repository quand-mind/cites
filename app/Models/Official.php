<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Official extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    
    protected $fillable = [
        'username',
        'email',
        'role',
        'user_id',
        'password',
        'remember_token'
    ];

    public function users()
    {
        return $this->hasOne(Users::class);
    }
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function isWriter()
    {
        return $this->role == 'writer';
    }

    /*protected static function newFactory()
    {
        return new OfficialFactory();
    }*/
}
