<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
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
            'email'     => env('ADMIN_EMAIL', 'admin@mail.com'),
            'password'  => bcrypt(env('ADMIN_PASSWORD', 'admin123')),
            'username'  => 'admin',
            'role'      => 'admin'
        ]);
    }
}
