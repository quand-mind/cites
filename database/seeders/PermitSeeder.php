<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class PermitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $date = strtotime("+60 day");
        $permit->valid_until = date('M d, Y', $date);

        DB::table('permit')->insert([
            'request_permit_no'      => $faker->randomNumber(8),
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 1,
            'permit_type_id' => 1
        ]);
        DB::table('permit')->insert([
            'request_permit_no'      => $faker->randomNumber(8),
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 1,
            'permit_type_id' => 1
        ]);
    }
}
