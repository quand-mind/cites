<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'institutional_email',
        'client_id'
    ];

    
    public function phones(){
        return $this->belongsToMany(Phone::class,
                                        'institution_phone',
                                        'institution_id',
                                        'phone_id');
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
