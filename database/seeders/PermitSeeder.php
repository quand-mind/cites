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
            'request_permit_no'      => Carbon::now()->format('ymd')."001",
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 1,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."002",
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 1,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."003",
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 1,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."004",
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 4,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."005",
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 4,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."006",
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 5,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."007",
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 5,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."008",
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 6,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."009",
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 6,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."010",
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 7,
            'permit_type_id' => 1
        ]);

        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."011",
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 7,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."012",
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 1,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."013",
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 8,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."014",
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 8,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."015",
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 9,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."016",
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 9,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."017",
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 10,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."018",
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 10,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."019",
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 11,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."020",
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 11,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."021",
            'purpose'      => "Exportacion de especies para el Zoológico El Pinar",
            'status'      => "requested",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 12,
            'permit_type_id' => 1
        ]);
        DB::table('permits')->insert([
            'request_permit_no'      => Carbon::now()->format('ymd')."022",
            'valid_until'      => date('M d, Y', $date),
            'purpose'      => "Exportacion de especies para el Zoológico del Parque Miranda",
            'status'      => "committed",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'client_id' => 12,
            'permit_type_id' => 1
        ]);

    }
}
