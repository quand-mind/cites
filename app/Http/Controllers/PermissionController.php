<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        return view('permissions.permissions');
    }

    public function showComercialExportSpecies()
    {
        return view('permissions.requirements.comercial_export_species_requirements');
    }
}
