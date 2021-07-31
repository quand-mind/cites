<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialNurseriesRequirement extends Model
{
    use HasFactory;
    protected $table = 'commercial_nurseries_requirements';

    protected $fillable = [
        'solicitude_file_url',
        'is_valid_solicitude',
        'solicitude_errors',
        'revenue_stamps_file_url',
        'is_valid_revenue_stamps',
        'revenue_stamps_errors',
        'proyect_file_url',
        'is_valid_proyect',
        'proyect_errors',
        'plane_file_url',
        'is_valid_plane',
        'plane_errors',
        'property_file_url',
        'is_valid_property_file',
        'property_file_errors',
        'client_id'
    ];
}
