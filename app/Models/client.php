<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Tymon\JWTAuth\Contracts\JWTSubject;

class client extends Model
{
    use HasFactory;
    protected $fillable = [
        'username',
        'email',
        'role',
        'user_id',
        'password'
    ];

    public function users()
    {
        return $this->hasOne(Users::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
