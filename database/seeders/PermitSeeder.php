<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
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
        $date = strtotime("+60 day");
        DB::table('permits')->insert([
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 1,
            'permit_type_id' => 1,
            'forlmalite_id' => 1
        
        ]);
        DB::table('permits')->insert([
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 1,
            'permit_type_id' => 1,
            'forlmalite_id' => 1
            
        ]);
        DB::table('permits')->insert([
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 1,
            'permit_type_id' => 1,
            'forlmalite_id' => 1
        ]);
        DB::table('permits')->insert([
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 4,
            'permit_type_id' => 1,
            'forlmalite_id' => 2
        ]);
        DB::table('permits')->insert([
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 4,
            'permit_type_id' => 1,
            'forlmalite_id' => 3
        ]);
        DB::table('permits')->insert([
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 5,
            'permit_type_id' => 1,
            'forlmalite_id' => 4
        ]);
        DB::table('permits')->insert([
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 5,
            'permit_type_id' => 1,
            'forlmalite_id' => 5
        ]);
        DB::table('permits')->insert([
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 6,
            'permit_type_id' => 1,
            'forlmalite_id' => 2
        ]);
        DB::table('permits')->insert([
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 6,
            'permit_type_id' => 1,
            'forlmalite_id' => 3
        ]);
        DB::table('permits')->insert([
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 7,
            'permit_type_id' => 1,
            'forlmalite_id' => 4
        ]);

        DB::table('permits')->insert([
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 7,
            'permit_type_id' => 1,
            'forlmalite_id' => 5
        ]);
        DB::table('permits')->insert([
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 1,
            'permit_type_id' => 1,
            'forlmalite_id' => 2
        ]);
        DB::table('permits')->insert([
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 8,
            'permit_type_id' => 1,
            'forlmalite_id' => 3
        ]);
        DB::table('permits')->insert([
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 8,
            'permit_type_id' => 1,
            'forlmalite_id' => 4
        ]);
        DB::table('permits')->insert([
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 9,
            'permit_type_id' => 1,
            'forlmalite_id' => 5
        ]);
        DB::table('permits')->insert([
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 9,
            'permit_type_id' => 1,
            'forlmalite_id' => 2
        ]);
        DB::table('permits')->insert([
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 10,
            'permit_type_id' => 1,
            'forlmalite_id' => 3
        ]);
        DB::table('permits')->insert([
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 10,
            'permit_type_id' => 1,
            'forlmalite_id' => 4
        ]);
        DB::table('permits')->insert([
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 11,
            'permit_type_id' => 1,
            'forlmalite_id' => 5
        ]);
        DB::table('permits')->insert([
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 11,
            'permit_type_id' => 1,
            'forlmalite_id' => 1
            
        ]);
        DB::table('permits')->insert([
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 12,
            'permit_type_id' => 1,
            'forlmalite_id' => 1
           
        ]);
        DB::table('permits')->insert([
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 12,
            'permit_type_id' => 1,
            'forlmalite_id' => 1
            
        ]);

    }
}
