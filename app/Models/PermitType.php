<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermitType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function permits()
    {
        return $this->hasMany(Permit::class);
    }

    public function requeriments()
    {
        return $this->belongsToMany(Requeriment::class, 
                                    'requeriment_permit_type',
                                    'permit_type_id',
                                    'requeriment_id');
    }
}
