<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(OfficialsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(ChatterTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
    }
}
