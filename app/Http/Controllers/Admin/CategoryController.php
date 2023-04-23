<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\ImageService;
use Exception;
use GuzzleHttp\Utils;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Category, Slide, Testimony
 */
class CategoryController extends Controller
{
    private ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
        $this->authorizeResource(Category::class);
    }

    /**
     * Display the master category or slide category.
     *
     * @param string $master
     * @return View
     */
    public function show(string $master): View
    {
        $masterCategoryList = Category::masterList($master)->get();
        abort_if(!view()->exists('admin.' . $master . '.master'), 404);
        return view('admin.' . $master . '.master', compact('masterCategoryList'));
    }

    /**
     * Show the form for updating master category.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function master(Request $request): RedirectResponse
    {
        Category::masterList($request->master)->pluck('id')->each(function ($id) use ($request) {
            $isActive = collect($request->all())->keys()->contains($id);
            Category::updateOrCreate(['id' => $id], ['is_active' => $isActive]);
        });

        return back()->withSuccess(trans('message.saved'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $master = $request->master;
        $masterCategory = Category::whereSlug($request->page ?? $master)->firstOrFail();
        $childCategoryList = $masterCategory->childList;
        $descendantCategoryList = $masterCategory->descendantList();

        return $this->getView($master, compact('master', 'masterCategory', 'childCategoryList', 'descendantCategoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        if ($request->file) {
            $request['image'] = $this->imageService->storeCategory($request->file);
        }

        Category::create($request->all());
        return back()->withSuccess(trans('message.saved'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        $masterCategory = $category->master();
        $master = $masterCategory->slug;

        if (collect(Category::OTHER)->contains($category->parent_slug_corrected)) {
            $masterCategory = $category->parent;
            $master = $category->parent_slug_corrected;
        }

        $childCategoryList = $masterCategory->childList;
        $descendantCategoryList = $masterCategory->descendantList();

        return $this->getView($master, compact('master', 'masterCategory', 'category', 'childCategoryList', 'descendantCategoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        if ($request->file) {
            $request['image'] = $this->imageService->storeCategory($request->file);
        }

        $category->update($request->all());

        $masterCategory = $category->master();
        $parameterArray = ['master' => $masterCategory->slug];

        if (collect(Category::OTHER)->contains($category->parent_slug_corrected)) {
            $parameterArray = array_merge($parameterArray, ['page' => $category->parent->slug]);
        }

        return to_route('category.index', $parameterArray)->withSuccess(trans('message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        $masterCategory = $category->master();
        $parameterArray = ['master' => $masterCategory->slug];

        if (collect(Category::OTHER)->contains($category->parent_slug_corrected)) {
            $parameterArray = array_merge($parameterArray, ['page' => $category->parent->slug]);
        }

        return to_route('category.index', $parameterArray)->withSuccess(trans('message.deleted'));
    }

    public function order(Request $request): string
    {
        foreach (Utils::jsonDecode($request->categoryList) as $order => $categoryJson) {
            $this->updateCategoryList($categoryJson, $request->master_id, $order);
        }

        return trans('message.updated');
    }

    public function updateCategoryList($categoryJson, $parentCategoryId, $order)
    {
        $category = Category::find($categoryJson->id);
        $category->category_id = $parentCategoryId;
        $category->order = $order;
        $category->save();
        if (isset($categoryJson->children)) {
            foreach ($categoryJson->children as $order => $childCategoryJson) {
                $this->updateCategoryList($childCategoryJson, $categoryJson->id, $order);
            }
        }
    }

    private function getView($master, $dataArray): View
    {
        $master = str($master)->remove('post');
        return view()->first(['admin.' . $master . '.index', 'admin.category.index'], $dataArray);
    }
}
