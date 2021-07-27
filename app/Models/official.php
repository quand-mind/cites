<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class official extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $fillable = [
        'username',
        'email',
        'role',
        'user_id',
        'password'
    ];
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
}
