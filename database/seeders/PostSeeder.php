<?php

namespace Database\Seeders;

use App\Enums\MasterType;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = User::firstWhere('email', 'admin@gmail.com')->id;
        $category = Category::whereSlug(MasterType::PAGE->value)->first();
        $categoryId = Category::insertGetId(['name' => 'Về chúng tôi', 'slug' => 've-chung-toi', 'category_id' => $category->id]);

        $postList = [
            ['name' => 'Giới thiệu', 'user_id' => $userId, 'is_active' => 1, 'slug' => 'gioi-thieu', 'content' => 'Dữ liệu đang được cập nhật'],
            ['name' => 'Giao hàng và nhận hàng', 'user_id' => $userId, 'is_active' => 1, 'slug' => 'giao-hang-va-nhan-hang', 'content' => 'Dữ liệu đang được cập nhật'],
            ['name' => 'Chính sách hàng nhập khẩu', 'user_id' => $userId, 'is_active' => 1, 'slug' => 'chinh-sach-hang-nhap-khau', 'content' => 'Dữ liệu đang được cập nhật'],
            ['name' => 'Chính sách đổi trả', 'user_id' => $userId, 'is_active' => 1, 'slug' => 'chinh-sach-doi-tra', 'content' => 'Dữ liệu đang được cập nhật'],
            ['name' => 'Chính sách bảo mật', 'user_id' => $userId, 'is_active' => 1, 'slug' => 'chinh-sach-bao-mat', 'content' => 'Dữ liệu đang được cập nhật'],
            ['name' => 'Hướng dẫn đặt hàng', 'user_id' => $userId, 'is_active' => 1, 'slug' => 'huong-dan-dat-hang', 'content' => 'Dữ liệu đang được cập nhật'],
            ['name' => 'Hướng dẫn thanh toán', 'user_id' => $userId, 'is_active' => 1, 'slug' => 'huong-dan-thanh-toan', 'content' => 'Dữ liệu đang được cập nhật'],
            ['name' => 'Về chúng tôi', 'user_id' => $userId, 'is_active' => 1, 'slug' => 've-chung-toi', 'content' => 'Dữ liệu đang được cập nhật'],
            ['name' => 'Chăm sóc khách hàng', 'user_id' => $userId, 'is_active' => 1, 'slug' => 'cham-soc-khach-hang', 'content' => 'Dữ liệu đang được cập nhật'],
            ['name' => 'Trang chủ', 'user_id' => $userId, 'is_active' => 1, 'slug' => 'trang-chu', 'content' => 'Dữ liệu đang được cập nhật'],
        ];

        foreach ($postList as $postRaw) {
            $post = Post::create($postRaw);
            $post->category()->sync($categoryId);
        }

        if (app()->isLocal()) {
            Category::factory(10)->hasPostList(5)->create();
            Category::factory()->product()->hasPostList(10)->create();
        }
    }
}
