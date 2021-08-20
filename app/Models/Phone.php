<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    protected $fillable = [
        'number'
    ];

    public function institutions(){
        return $this->belongsToMany(Institution::class,
                                        'institution_phone',
                                        'institution_id',
                                        'phone_id');
    }
}
