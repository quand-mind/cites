<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'      => 'Admin',
            'dni'       => '27647120'
            /*'email'     => 'admin@mail.com',
            'password'  => bcrypt('admin123'),
            'username'  => 'admin',
            'role'      => 'admin',
            'remember_token' => Str::random(10)*/
        ]);

        DB::table('users')->insert([
            'name'      => 'Super',
            'dni'       => '27647121'
            /*'email'     => 'superuser@mail.com',
            'password'  => bcrypt('super123'),
            'username'  => 'superuser',
            'role'      => 'superuser'*/
        ]);

        DB::table('users')->insert([
            'name'      => 'Writer Tester',
            'dni'       => '27647122'
            /*'email'     => 'writer@mail.com',
            'password'  => bcrypt('writer123'),
            'username'  => 'writertester',
            'role'      => 'writer'*/
        ]);

        /*User::factory()->count(20)->create([
            'role' => 'writer'
        ]);

        User::factory()->count(5)->create([
            'role' => 'admin'
        ]);

        User::factory()->count(50)->create([
            'role' => 'client'
        ]);
        User::factory()->count(50)->create([
            'role' => 'perosna_juridica'
        ]);
        User::factory()->count(50)->create([
            'role' => 'persona_natural'
        ]);*/
    }
}
