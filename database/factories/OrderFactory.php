<?php

namespace Database\Factories;

use App\Enums\MasterType;
use App\Enums\ProcessType;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    public function configure()
    {
        return $this->afterCreating(function (Order $order) {
            $masterCategory = Category::whereSlug(MasterType::PRODUCT->value)->first();
            $postList = $masterCategory->descendantPostList()->published()->get()->random(rand(1, 3));
            foreach ($postList as $post) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'post_id' => $post->id,
                    'quantity' => rand(1, 5),
                    'price' => $post->price_corrected
                ]);
            }
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => str(str()->random(5))->upper(),
            'contact_id' => Contact::factory()->create(),
            'content' => fake()->sentence(),
            'status' => collect(ProcessType::cases())->pluck('value')->random()
        ];
    }
}
