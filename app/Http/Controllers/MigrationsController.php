<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MigrationsController extends Controller
{
    /**
     * Run migrations with seeders.
     *
     * @return String
     */
    public function seed()
    {
        Artisan::call('migrate', array('--path' => 'database/migrations', '--force' => true, '--seed' => true));
        return "Migration completed";
    }

    /**
     * Run migrations.
     *
     * @return String
     */
    public function migrate()
    {
        Artisan::call('migrate', array('--path' => 'database/migrations', '--force' => true));
        return "Migration completed";
    }
}
