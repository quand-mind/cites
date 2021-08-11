<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PermitRequerimentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 1,
            'requeriment_id'      => 1,
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 1,
            'requeriment_id'      => 2,
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 1,
            'requeriment_id'      => 3,
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 1,
            'requeriment_id'      => 4,
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 1,
            'requeriment_id'      => 5,
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 1,
            'requeriment_id'      => 6,
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 1,
            'requeriment_id'      => 7,
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 1,
            'requeriment_id'      => 8,
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 1,
            'requeriment_id'      => 9,
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 1,
            'requeriment_id'      => 10,
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 1,
            'requeriment_id'      => 11,
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 1,
            'requeriment_id'      => 12,
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 1,
            'requeriment_id'      => 13,
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 1,
            'requeriment_id'      => 14,
        ]);

        
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 2,
            'requeriment_id'      => 1,
            'is_valid'      => true,
            'file_url'      => 'https://developer.android.com/studio/images/debug/devicefileexplorer-callouts_2x.png?hl=es',
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 2,
            'requeriment_id'      => 2,
            'is_valid'      => true,
            'file_url'      => 'https://developer.android.com/studio/images/debug/devicefileexplorer-callouts_2x.png?hl=es',
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 2,
            'requeriment_id'      => 3,
            'is_valid'      => true,
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 2,
            'requeriment_id'      => 4,
            'is_valid'      => true,
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 2,
            'requeriment_id'      => 5,
            'is_valid'      => true,
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 2,
            'requeriment_id'      => 6,
            'is_valid'      => true,
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 2,
            'requeriment_id'      => 7,
            'is_valid'      => true,
            'file_url'      => 'https://developer.android.com/studio/images/debug/devicefileexplorer-callouts_2x.png?hl=es',
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 2,
            'requeriment_id'      => 8,
            'is_valid'      => true,
            'file_url'      => 'https://developer.android.com/studio/images/debug/devicefileexplorer-callouts_2x.png?hl=es',
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 2,
            'requeriment_id'      => 9,
            'is_valid'      => true,
            'file_url'      => 'https://developer.android.com/studio/images/debug/devicefileexplorer-callouts_2x.png?hl=es',
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 2,
            'requeriment_id'      => 10,
            'is_valid'      => true,
            'file_url'      => 'https://developer.android.com/studio/images/debug/devicefileexplorer-callouts_2x.png?hl=es',
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 2,
            'requeriment_id'      => 11,
            'is_valid'      => true,
            'file_url'      => 'https://developer.android.com/studio/images/debug/devicefileexplorer-callouts_2x.png?hl=es',
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 2,
            'requeriment_id'      => 12,
            'is_valid'      => true,
            'file_url'      => 'https://developer.android.com/studio/images/debug/devicefileexplorer-callouts_2x.png?hl=es',
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 2,
            'requeriment_id'      => 13,
            'is_valid'      => true,
            'file_url'      => 'https://developer.android.com/studio/images/debug/devicefileexplorer-callouts_2x.png?hl=es',
        ]);
        DB::table('permit_requeriment')->insert([
            'permit_id'      => 2,
            'requeriment_id'      => 14,
            'is_valid'      => true,
            'file_url'      => 'https://developer.android.com/studio/images/debug/devicefileexplorer-callouts_2x.png?hl=es',
        ]);
    }
}
