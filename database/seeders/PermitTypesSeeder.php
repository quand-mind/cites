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
            'type'      => 'export',
            'status'      => 'active',
            'departament_id' => 1
        ]);
        DB::table('permit_types')->insert([
            'name'      => ' Permiso de importación con fines comerciales de especímenes de fauna de especies incluidas en los apéndices de la CITES.',
            'type'      => 'import',
            'status'      => 'active',
            'departament_id' => 1
        ]);
        DB::table('permit_types')->insert([
            'name'      => ' Permiso de reexportación con fines comerciales de especímenes de fauna de especies incluidas en los apéndices de la CITES',
            'type'      => 'reexport',
            'status'      => 'active',
            'departament_id' => 1
        ]);
    }
}
