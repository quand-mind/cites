<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $arr = [];
        for ($i = 1; $i <= 20; $i++) {
            array_push($arr, $i);
        }
        
        return [
            'author' => $this->faker->name(),
            'date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'alt_img' => 'my image',
            'url' => $this->faker->image(null, $width = 920, $height = 1080, 'cats', false), // '13b73edae8443990be1aa8f1a483bc27.jpg' it's a filename without path
            'post_id' => $this->faker->randomElement($arr)
        ];
    }
}
