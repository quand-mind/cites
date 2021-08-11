<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permit extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_permit_no',
        'means',
        'permit_type',
        'valid_until',
        'special_conditions',
        'purpose',
        'half_signature',
        'issued_by',
        'official_position',
        'palce',
        'date_permit',
        'permit_cancele',
        'observations',
        'port',
        'departure_date'
    ];

    public function species()
    {
        return $this->belongsToMany(species::class,
                                    'permit_species',
                                    'permit_id',
                                    'species_id');
    }
    public function client ()
    {
        return $this->belongsToMany()
    }
    
}
