<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class species extends Model
{
    use HasFactory;
    protected $fillable = [
        'ap',
        'name_scientific',
        'name_common',
        'decription',
        //'qty',
        //'unity',
        'country_origin',
        //'permit_no',
        //'code_stamp',
        //'date'
    ];

    public function permits()
    {
        return $this->belongsToMany(permits::class, 
                                    'permit_specie',
                                    'permit_id',
                                    'species_id');
    }
    
}
