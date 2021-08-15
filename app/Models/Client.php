<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Tymon\JWTAuth\Contracts\JWTSubject;

class Client extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $fillable = [
        'username',
        'email',
        'role',
        'user_id',
        'api_token',
        'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function users()
    {
        return $this->hasOne(User::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function permits()
    {
        return $this->hasMany(Permit::class);
    }
}
