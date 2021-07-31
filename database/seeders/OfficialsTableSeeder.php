<?php

namespace Database\Seeders;
use App\Models\official;
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
            'email'     => 'admin@mail.com',
            'password'  => bcrypt('admin123'),
            'username'  => 'admin',
            'role'      => 'admin',
            'user_id'   => 1,
            'remember_token' => Str::random(10)
        ]);
        DB::table('officials')->insert([
            'email'     => 'superuser@mail.com',
            'password'  => bcrypt('super123'),
            'username'  => 'superuser',
            'role'      => 'superuser',
            'user_id'   => 2,
            'remember_token' => Str::random(10)
        ]);
        DB::table('officials')->insert([
            'email'     => 'writer@mail.com',
            'password'  => bcrypt('writer123'),
            'username'  => 'writertester',
            'role'      => 'writer',
            'user_id'   => 3,
            'remember_token' => Str::random(10)
        ]);
        
        official::factory()->count(20)->create([
            'role' => 'writer'
        ]);

        official::factory()->count(5)->create([
            'role' => 'admin'
        ]);

        /*DB::table('clients')->insert([
            
            'email'     => 'client@mail.com',
            'password'  => bcrypt('client123'),
            'username'  => 'client',
            'role'      => 'persona_natural',
            'user_id'   => 1,
        ]);*/
    }
}
