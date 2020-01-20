<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MigrationsController extends Controller
{
    public function seed()
    {
        Artisan::call('migrate', array('--path' => 'database/migrations', '--force' => true, '--seed' => true));
        return "Migration completed";
    }
}
