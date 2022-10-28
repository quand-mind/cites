<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departaments')->insert([
            'name'      => 'Diversidad Biológica',
            'acronym' => 'DB'
        ]);
    }
}
