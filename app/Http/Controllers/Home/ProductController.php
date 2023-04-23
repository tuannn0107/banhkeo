<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class ProductController extends Controller
{
    public function index(string $categorySlug)
    {
        $category = Category::whereSlug($categorySlug)->first();
        $page = Post::firstWhere('slug', $categorySlug);
        $postList = $category->descendantPostList()->published()->sort(request()->sort)->get();
        return view('home.product.index', compact('category', 'postList', 'page'));
    }

    public function detail(string $categorySlug, Post $post)
    {
        $category = Category::whereSlug($categorySlug)->first();
        $postList = $category->descendantPostList()->published()->latest()->get();
        return view('home.product.detail', compact('category', 'post', 'postList'));
    }
}
