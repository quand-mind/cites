<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();

        return [
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('123456'), // secret
            //'remember_token' => Str::random(10),
            'username' => strtolower(str_replace(' ', '_', $name)),
            'user_id' => rand(4, 23),
        ];
    }
}
