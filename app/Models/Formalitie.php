<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formalitie extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_sistra', 
        'status', 
    ];

    public function permits(){
        return $this->belongsTo(Permit::class);
    }
}
