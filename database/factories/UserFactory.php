<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

class UserFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();

        return [
            'name' => $name,
            'dni' => $this->faker->unique()->numerify('########'),
            'domicile'  => $this->faker->state,
            'address'   => $this->faker->address,
            'fax'       => $this->faker->tollFreePhoneNumber,
            'photo' => $this->faker->imageUrl($width = 200, $height = 200),
            'rif_institution' => 'J'.$this->faker->unique()->numerify('########')
        ];
    }
}
