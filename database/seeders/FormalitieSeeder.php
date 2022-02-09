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
            'request_formalitie_no' => Carbon::now()->format('ymd')."001",
            'status' => 'uploading_requeriments',
            'client_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'collected_time' => Carbon::now()->toDateString()
            
        ]);
        DB::table('formalities')->insert([
            'request_formalitie_no' => Carbon::now()->format('ymd')."002",
            'status' => 'uploading_requeriments',
            'client_id' => 4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'collected_time' => Carbon::now()->toDateString()
        ]);
        DB::table('formalities')->insert([
            'request_formalitie_no' => Carbon::now()->format('ymd')."003",
            'status' => 'uploading_requeriments',
            'client_id' => 4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('formalities')->insert([
            'request_formalitie_no' => Carbon::now()->format('ymd')."004",
            'status' => 'uploading_requeriments',
            'client_id' => 5,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('formalities')->insert([
            'request_formalitie_no' => Carbon::now()->format('ymd')."005",
            'status' => 'uploading_requeriments',
            'client_id' => 5,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
