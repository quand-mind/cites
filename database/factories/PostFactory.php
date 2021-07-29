<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'title' => $this->faker->unique()->realText($maxNbChars = 50, $indexSize = 1),
            'publish_date' => $this->faker->dateTime($max = 'now', $timezone = null),
            'author_id' => rand(1, 3),
            'content' => $this->faker->realText($maxNbChars = 300, $indexSize = 2)
        ];
    }
}
