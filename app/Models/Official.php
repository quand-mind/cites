<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Tymon\JWTAuth\Contracts\JWTSubject;


class Official extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use Notifiable;
    
    protected $fillable = [
        'username',
        'email',
        'role',
        'is_active',
        'user_id',
        'password',
        'remember_token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function permits()
    {
        return $this->hasMany(Permit::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
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
