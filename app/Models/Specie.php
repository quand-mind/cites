<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specie extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'ap',
        'type',
        'name_scientific',
        'name_common',
        'search_id',
        //'qty',
        //'unity',
        // 'country_origin',
        //'permit_no',
        //'code_stamp',
        //'date'
    ];

    public function permits()
    {
        return $this->belongsToMany(Permit::class, 
                                    'permit_specie',
                                    'permit_id',
                                    'species_id')->withPivot('file_url', 'is_valid', 'qty');
    }
}
