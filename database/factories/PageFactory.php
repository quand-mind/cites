<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'meta_description' => $this->faker->text($maxNbChars = 150),
            'meta_keywords' => $this->faker->words($nb = 20, $variableNbWords= true),
            'content' => $this->faker->realText($maxNbChars = 200),
            'is_active' => true,
            'created_by' => 1,
            'lastModified_by' => 1
        ];
    }
}
