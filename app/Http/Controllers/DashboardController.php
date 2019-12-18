<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * This Controller only render the views of the dashboard
     */

    public function index () {
        return view('panel.dashboard.index');
    }
}
