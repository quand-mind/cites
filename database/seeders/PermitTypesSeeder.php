<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermitTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permit_types')->insert([
            'name'      => 'Permiso de exportación de especies de la fauna silvestre incluidas en CITES con fines comerciales.',
        ]);
    }
}
