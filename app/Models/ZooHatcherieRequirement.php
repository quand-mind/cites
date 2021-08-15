<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZooHatcherieRequirement extends Model
{
    use HasFactory;

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
        'property_file_url',
        'is_valid_property_file',
        'property_file_errors',
        'territory_occupation_authorization_file_url',
        'is_valid_territory_occupation_authorization_file',
        'territory_occupation_authorization_file_errors',
        'foliate_control_book_file_url',
        'is_valid_foliate_control_book_file',
        'foliate_control_book_file_errors',
        'client_id'
    ];
}
