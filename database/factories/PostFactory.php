<?php

namespace Database\Factories;

use App\Enums\ProductType as ProductTypeEnum;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Models\ProductType;
use App\Models\Seo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            if (rand(0, 1)) {
                $post->seo()->save(Seo::factory()->make());
            }

            if (rand(0, 1)) {
                $post->commentList()->saveMany(Comment::factory(rand(1, 3))->make());
                foreach ($post->commentList as $comment) {
                    if (rand(0, 1)) {
                        $post->commentList()->saveMany(Comment::factory(rand(1, 3))->make([
                            'comment_id' => $comment->id,
                        ]));
                    }
                }
            }

            foreach (ProductTypeEnum::cases() as $productType) {
                if (rand(0, 1)) {
                    ProductType::create(['name' => $productType->value, 'post_id' => $post->id]);
                }
            }
            $post->imageList()->saveMany(Image::factory(rand(1, 6))->make());
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sentence = fake()->sentence();
        $price = rand(1, 10000) * 1000;
        return [
            'user_id' => rand(1, 3),
            'name' => $sentence,
            'image' => 'https://picsum.photos/' . rand(1200, 1600) . '/' . rand(500, 800),
            'slug' => str($sentence)->slug(),
            'rating' => rand(0, 1) ? null : rand(0, 50),
            'price' => $price,
            'sale_price' => rand(0, 1) ? null : ($price * rand(0, 100) / 100),
            'is_active' => rand(0, 1),
            'published_at' => now()->addDays(rand(-10, 10)),
            'content' => fake()->paragraph(rand(50, 100)) . '<br/><img src="https://picsum.photos/'
                . rand(500, 1000) . '/' . rand(500, 1000) . '"><br/>' . fake()->paragraph(rand(50, 100))
        ];
    }
}
