<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequerimentPermitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('requeriment_permit_type')->insert([
            'permit_type_id'      => 1,
            'requeriment_id'      => 1,
        ]);

        DB::table('requeriment_permit_type')->insert([
            'permit_type_id'      => 1,
            'requeriment_id'      => 2,
        ]);

        DB::table('requeriment_permit_type')->insert([
            'permit_type_id'      => 1,
            'requeriment_id'      => 3,
        ]);

        DB::table('requeriment_permit_type')->insert([
            'permit_type_id'      => 1,
            'requeriment_id'      => 4,
        ]);

        DB::table('requeriment_permit_type')->insert([
            'permit_type_id'      => 1,
            'requeriment_id'      => 5,
        ]);

        DB::table('requeriment_permit_type')->insert([
            'permit_type_id'      => 1,
            'requeriment_id'      => 6,
        ]);

        DB::table('requeriment_permit_type')->insert([
            'permit_type_id'      => 1,
            'requeriment_id'      => 7,
        ]);

        DB::table('requeriment_permit_type')->insert([
            'permit_type_id'      => 1,
            'requeriment_id'      => 8,
        ]);

        DB::table('requeriment_permit_type')->insert([
            'permit_type_id'      => 1,
            'requeriment_id'      => 9,
        ]);

        DB::table('requeriment_permit_type')->insert([
            'permit_type_id'      => 1,
            'requeriment_id'      => 10,
        ]);

        DB::table('requeriment_permit_type')->insert([
            'permit_type_id'      => 1,
            'requeriment_id'      => 11,
        ]);

        DB::table('requeriment_permit_type')->insert([
            'permit_type_id'      => 1,
            'requeriment_id'      => 12,
        ]);

        DB::table('requeriment_permit_type')->insert([
            'permit_type_id'      => 1,
            'requeriment_id'      => 13,
        ]);

        DB::table('requeriment_permit_type')->insert([
            'permit_type_id'      => 1,
            'requeriment_id'      => 14,
        ]);
    }
}
