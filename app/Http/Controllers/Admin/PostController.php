<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StageType;
use App\Enums\ProductType as ProductTypeEnum;
use App\Models\ProductType;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
        $this->authorizeResource(Post::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $statusType = $request->status ?? StageType::ALL->value;
        $masterCategory = Category::whereSlug($request->master)->firstOrFail();
        $postList = $masterCategory->descendantPostList()->ofStatus($statusType)->currentUser()->get();
        $statusList = StageType::ALL->stageList();

        return view('admin.post.index', compact('masterCategory', 'postList', 'statusType', 'statusList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return View
     */
    public function create(Request $request): View
    {
        $master = $request->master;
        $categoryList = $this->postService->getCategoryList($master);
        $productTypeList = ProductTypeEnum::FEATURED_PRODUCTS->productTypeList();
        return view('admin.post.create', compact('categoryList', 'master', 'productTypeList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $post = $this->postService->store($request);

        if ($request->new || !$post) {
            return back()->withSuccess(trans('message.saved'));
        }

        return to_route('post.edit', $post->id)->withSuccess(trans('message.saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return void
     */
    public function show(Post $post)
    {
        // NOP
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return View
     */
    public function edit(Post $post): View
    {
        $master = $post->category()->first()->master()->slug;
        $categoryList = $this->postService->getCategoryList($master);
        $productTypeList = ProductTypeEnum::FEATURED_PRODUCTS->productTypeList();
        $currentProductTypeList = ProductType::wherePostId($post->id)->pluck('name');
        $seo = $post->seo;
        return view('admin.post.edit',
            compact('post', 'categoryList', 'master', 'seo', 'productTypeList', 'currentProductTypeList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $master = $request->master;
        $this->postService->update($post, $request);

        if (!$request->back) {
            return back()->withSuccess(trans('message.updated'));
        }

        return to_route('post.index', compact('master'))->withSuccess(trans('message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return back()->withSuccess(trans('message.deleted'));
    }
}
