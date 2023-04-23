<?php

namespace Database\Factories;

use App\Enums\MasterType;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = fake()->name();
        return [
            'category_id' => Category::masterList()->pluck('id', 'slug')->except(MasterType::SLIDE->value)->values()->random(),
            'name' => $name,
            'slug' => str($name)->slug(),
            'image' => 'https://picsum.photos/' . rand(1200, 1600) . '/' . rand(500, 800),
            'order' => rand(0, 10),
            'content' => fake()->sentence(rand(6, 12))
        ];
    }

    public function product()
    {
        return $this->state(function (array $attributes) {
            return [
                'category_id' => Category::whereSlug(MasterType::PRODUCT->value)->value('id'),
            ];
        });
    }
}
