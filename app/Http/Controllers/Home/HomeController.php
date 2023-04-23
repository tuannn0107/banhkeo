<?php

namespace App\Http\Controllers\Home;

use App\Enums\MasterType;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;

class HomeController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $post = Post::firstWhere('slug', 'trang-chu');
        $slideList = Category::masterList('home-slide')->active()->get();
        $masterCategory = Category::whereSlug(MasterType::PRODUCT->value)->first();
        $categoryList = $this->postService->getCategoryList($masterCategory->slug);

        $masterCategory = Category::whereSlug(MasterType::POST->value)->firstOrFail();
        $postList = $masterCategory->descendantPostList()->published()->latest()->take(6)->get();

        return view('home.index', compact('slideList', 'categoryList', 'postList', 'post'));
    }
}
