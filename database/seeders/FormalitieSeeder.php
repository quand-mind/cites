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
            'request_permit_no' => Carbon::now()->format('ymd')."001",
            'status' => 'solicitado'
        ]);
        DB::table('formalities')->insert([
            'request_permit_no' => Carbon::now()->format('ymd')."002",
            'status' => 'solicitado'
        ]);
        DB::table('formalities')->insert([
            'request_permit_no' => Carbon::now()->format('ymd')."003",
            'status' => 'solicitado'
        ]);
        DB::table('formalities')->insert([
            'request_permit_no' => Carbon::now()->format('ymd')."004",
            'status' => 'solicitado'
        ]);
        DB::table('formalities')->insert([
            'request_permit_no' => Carbon::now()->format('ymd')."005",
            'status' => 'solicitado'
        ]);
    }
}
