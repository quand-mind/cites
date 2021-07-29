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
            
        ]);

        DB::table('users')->insert([
            'name'      => 'Super',
            'dni'       => '27647121'
            
        ]);

        DB::table('users')->insert([
            'name'      => 'Writer Tester',
            'dni'       => '27647122'
            
        ]);

        User::factory()->count(20)->create();
        
        
    }
}
