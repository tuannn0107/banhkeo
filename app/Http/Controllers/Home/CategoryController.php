<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index($slug, Category $category)
    {
        $postList = $category->descendantPostList()->published()->get();
        return view('home.product.index', compact('category', 'postList'));
    }
}
