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
        'appendix',
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
                                    'specie_id',
                                    'permit_id')->withPivot('file_url', 'origin', 'origin_country', 'description', 'qty');
    }
}
