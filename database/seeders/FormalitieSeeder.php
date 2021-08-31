<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class FormalitieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('formalities')->insert([
            'request_formality_no' => Carbon::now()->format('ymd')."001",
            'status' => 'solicitado',
            'client_id' => 1,
            
        ]);
        DB::table('formalities')->insert([
            'request_formality_no' => Carbon::now()->format('ymd')."002",
            'status' => 'solicitado',
            'client_id' => 4,
        ]);
        DB::table('formalities')->insert([
            'request_formality_no' => Carbon::now()->format('ymd')."003",
            'status' => 'solicitado',
            'client_id' => 4,
        ]);
        DB::table('formalities')->insert([
            'request_formality_no' => Carbon::now()->format('ymd')."004",
            'status' => 'solicitado',
            'client_id' => 5,
        ]);
        DB::table('formalities')->insert([
            'request_formality_no' => Carbon::now()->format('ymd')."005",
            'status' => 'solicitado',
            'client_id' => 5,
        ]);
    }
}
