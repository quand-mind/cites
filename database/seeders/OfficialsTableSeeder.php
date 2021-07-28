<?php

namespace Database\Seeders;
use App\Models\officials;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OfficialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('officials')->insert([
            //'name'      => 'Admin',
            //'dni'       => '27647120'
            'email'     => 'admin@mail.com',
            'password'  => bcrypt('admin123'),
            'username'  => 'admin',
            'role'      => 'admin',
            'user_id'   => 1,
            'remember_token' => Str::random(10)
        ]);
        DB::table('officials')->insert([
            //'name'      => 'Admin',
            //'dni'       => '27647120'
            'email'     => 'superuser@mail.com',
            'password'  => bcrypt('super123'),
            'username'  => 'superuser',
            'role'      => 'superuser',
            'user_id'   => 2,
            'remember_token' => Str::random(10)
        ]);
        DB::table('officials')->insert([
            //'name'      => 'Admin',
            //'dni'       => '27647120'
            'email'     => 'writer@mail.com',
            'password'  => bcrypt('writer123'),
            'username'  => 'writertester',
            'role'      => 'writer',
            'user_id'   => 3,
            'remember_token' => Str::random(10)
        ]);
        DB::table('clients')->insert([
            //'name'      => 'Admin',
            //'dni'       => '27647120'
            'email'     => 'client@mail.com',
            'password'  => bcrypt('client123'),
            'username'  => 'client',
            'role'      => 'persona_natural',
            'user_id'   => 1,
        ]);
    }
}
