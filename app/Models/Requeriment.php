<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requeriment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'short_name',
        'type'
    ];

    public function permits()
    {
        return $this->belongsToMany(permits::class, 
                                    'permit_requeriment',
                                    'permit_id',
                                    'requeriment_id')->withPivot('file_url', 'is_valid');
    }
    public function permitTypes()
    {
        return $this->belongsToMany(permits::class, 
                                    'requeriment_permit_type',
                                    'permit_type_id',
                                    'requeriment_id');
    }
}
