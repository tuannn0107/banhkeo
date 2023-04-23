<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class CmsController extends Controller
{
    public function __invoke()
    {
        return cache()->get('cmsList')->pluck('content', 'name');
    }
}
