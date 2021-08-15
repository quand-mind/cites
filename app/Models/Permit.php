<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_permit_no',
        'valid_until',
        'special_conditions',
        'purpose',
        'status',
        'observations',
        'transportation_way_origin',
        'consignado_a_origin',
        'origin_country',
        'transportation_way_destiny',
        'destiny_country',
        'consignado_a_destiny',
        'port_boarding_destiny',
        'port_disembarkation_destiny',
        'destiny_place',
        'place_departure',
        'departure_date'
    ];

    public function species()
    {
        return $this->belongsToMany(Specie::class,
                                    'permit_specie',
                                    'permit_id',
                                    'specie_id')->withPivot('file_url', 'is_valid', 'qty');
    }
    public function client()
    {
        
        return $this->belongsTo(Client::class);
    }
    public function permit_type()
    {
        
        return $this->belongsTo(PermitType::class);
    }
    public function requeriments()
    {

        return $this->belongsToMany(Requeriment::class,
                                    'permit_requeriment',
                                    'permit_id',
                                    'requeriment_id')->withPivot('file_url', 'is_valid', 'file_errors');
    }
    
}
