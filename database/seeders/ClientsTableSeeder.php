<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            
            'email'     => 'client@mail.com',
            'password'  => bcrypt('client123'),
            'username'  => 'client',
            'role'      => 'persona_natural',
            'user_id'   => 1,

        ]);

        Client::factory()->count(10)->create([
            'role' => 'persona_juridica'
        ]);

        Client::factory()->count(10)->create([
            'role' => 'persona_natural'
        ]);
    }
}
