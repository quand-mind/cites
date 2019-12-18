<?php

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
            'email'     => 'admin@mail.com',
            'password'  => bcrypt('admin123'),
            'username'  => 'admin',
            'role'      => 'admin'
        ]);

        DB::table('users')->insert([
            'name'      => 'Super',
            'email'     => 'superuser@mail.com',
            'password'  => bcrypt('super123'),
            'username'  => 'superuser',
            'role'      => 'superuser'
        ]);

        DB::table('users')->insert([
            'name'      => 'Writer Tester',
            'email'     => 'writer@mail.com',
            'password'  => bcrypt('writer123'),
            'username'  => 'writertester',
            'role'      => 'writer'
        ]);
    }
}
