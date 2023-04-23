<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VisitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'source' => collect(['facebook', 'google'])->random(),
            'ip' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
            'created_at' => now()->subDays(rand(0, 100))
        ];
    }

    /**
     * Indicate that the location is fetched.
     */
    public function fetched()
    {
        return $this->state(function (array $attributes) {
            return [
                'region' => fake()->city(),
                'country' => fake()->country(),
                'latitude' => fake()->latitude(),
                'longitude' => fake()->longitude(),
                'timezone' => fake()->timezone(),
                'organization' => fake()->company(),
                'as' => fake()->company(),
                'use_mobile_connection' => fake()->boolean(),
                'use_proxy' => fake()->boolean(),
                'status' => 1,
            ];
        });
    }
}
