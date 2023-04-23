<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function index(string $categorySlug)
    {
        $category = Category::whereSlug($categorySlug)->first();
        $page = Post::firstWhere('slug', $categorySlug);
        $postList = $category->descendantPostList()->published()->latest()->get();
        return view('home.post.index', compact('category', 'postList', 'page'));
    }

    public function detail(string $categorySlug, Post $post)
    {
        $category = Category::whereSlug($categorySlug)->first();
        $postList = $category->descendantPostList()->published()->latest()->get();
        return view('home.post.detail', compact('category', 'post', 'postList'));
    }
}
