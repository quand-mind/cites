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
        'transportation_way',
        'consigned_to',
        'country',
        'landing_port',
        'shipment_port',
        'destiny_place',
        'departure_place',
        'departure_date'
    ];

    public function species()
    {
        return $this->belongsToMany(Specie::class,
                                    'permit_specie',
                                    'permit_id',
                                    'specie_id')->withPivot('file_url', 'description','is_valid', 'qty', 'file_errors');
    }
    public function clients()
    {
        
        return $this->belongsTo(Client::class);
    }
    public function official()
    {
        
        return $this->belongsTo(Official::class);
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
