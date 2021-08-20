<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('users')->insert([
            'name'      => 'Admin',
            'nationality'=> 'Venezolano',
            'dni'       => '27647120',
            'domicile'  => 'Caracas',
            'address'   => 'Av urdaneta edificio dorsay',
            'fax'       => $faker->tollFreePhoneNumber,
        ]);

        DB::table('users')->insert([
            'name'      => 'Super',
            'nationality'=> 'Venezolano',
            'dni'       => '27647121',
            'domicile'  => 'Caracas',
            'address'   => 'Av urdaneta edificio dorsay',
            'fax'       => $faker->tollFreePhoneNumber,
        ]);

        DB::table('users')->insert([
            'name'      => 'Writer Tester',
            'nationality'=> 'Venezolano',
            'dni'       => '27647122',
            'domicile'  => 'Caracas',
            'address'   => 'Av urdaneta edificio dorsay',
            'fax'       => $faker->tollFreePhoneNumber,
        ]);

        User::factory()->count(10)->create([
            'nationality' => 'Venezolano'
        ]);

        User::factory()->count(10)->create([
            'nationality' => 'Extranjero'
        ]);
        
        
    }
}
