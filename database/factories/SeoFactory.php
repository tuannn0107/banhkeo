<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SeoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sentence = fake()->sentence();
        return [
            'title' => $sentence,
            'canonical' => str($sentence)->slug(),
            'description' => fake()->text(150),
            'robots' => collect(['index, follow', 'noindex, nofollow'])->random()
        ];
    }
}
