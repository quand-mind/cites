<?php

namespace Database\Seeders;
use App\Models\Official;
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
            'email'     => 'writer@ .com',
            'password'  => bcrypt('writer123'),
            'username'  => 'writertester',
            'role'      => 'writer',
            'user_id'   => 3,
            'remember_token' => Str::random(10)
        ]);
        
        /*Official::factory()->count(10)->create([
            'role' => 'writer'
        ]);

        Official::factory()->count(10)->create([
            'role' => 'admin'
        ]);*/

        
    }
}
