<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermitType;
use App\Models\User;
use App\Models\Client;

class PermitTypeController extends Controller
{
    public function index()
    {
        $clientData = Client::with('user')->where('id', '=', auth()->user()->id)->get();
        $permitTypes = PermitType::with(['requeriments'])->get();
        return view('permissions.permissions_list', compact(['permitTypes', 'clientData']));
    }
}
