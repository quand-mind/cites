<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermitType;
use App\Models\User;

class PermitTypeController extends Controller
{
    public function index()
    {
        $clientData = User::with('clients')->where('id', '=', auth()->user()->id)->get();
        $permitTypes = PermitType::with(['requeriments'])->get();
        return view('permissions.permissions_list', compact(['permitTypes', 'clientData']));
    }
}
