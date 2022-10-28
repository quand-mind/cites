<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formalitie extends Model
{
    use HasFactory;

    protected $fillable = [
        'sistra', 
        'status', 
        'request_formalitie_no', 
        'special_conditions', 
        'collected_time',
        'observations',
        'collected_time',
        'official_id',
        'created_at',
        'updated_at',
        'client_id',
    ];

    public function permits()
    {
        return $this->hasMany(Permit::class);
    }
    public function client()
    {
        
        return $this->belongsTo(Client::class);
    }
    public function official()
    {
        
        return $this->belongsTo(Official::class);
    }
}
