<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermitType;

class PermitTypeController extends Controller
{
    public function index()
    {
        $permitTypes = PermitType::with(['requeriments'])->get();
        return view('permissions.permissions_list', compact('permitTypes'));
    }
}
