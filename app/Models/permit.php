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
        return $this->belongsToMany(Specie::class,
                                    'permit_specie',
                                    'permit_id',
                                    'specie_id')->withPivot('file_url', 'is_valid', 'qty');
    }
    public function client()
    {
        
        return $this->belongsTo(client::class);
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
