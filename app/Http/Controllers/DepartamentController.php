<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use Illuminate\Http\Request;

class DepartamentController extends Controller
{
    public function index()
    {
        $departaments = Departament::get();
        return $departaments;
    }
}
