<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PageController extends Controller
{
    public function index(string $pageSlug)
    {
        $post = Post::whereSlug($pageSlug)->firstOrFail();
        return view('home.page.index', compact('post'));
    }
}
