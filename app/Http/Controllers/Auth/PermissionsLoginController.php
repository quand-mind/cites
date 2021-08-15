<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Session;
class PermissionsLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.permissions_login');
    }
}
