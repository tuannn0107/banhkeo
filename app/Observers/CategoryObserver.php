<?php

namespace App\Observers;

use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    private ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Handle the configuration "creating" event.
     *
     * @param Category $category
     * @return void
     */
    public function created(Category $category): void
    {
        Cache::forget('masterList');
        Cache::forget('productCategoryList');
        Cache::forget('postCategoryList');
    }

    /**
     * Handle the Category "updated" event.
     *
     * @param Category $category
     * @return void
     */
    public function updated(Category $category): void
    {
        Cache::forget('masterList');
        Cache::forget('productCategoryList');
        Cache::forget('postCategoryList');
        if ($category->getOriginal('image') && $category->isDirty('image')) {
            $this->imageService->delete($category->getOriginal('image'));
        }
    }

    /**
     * Handle the Category "deleted" event.
     *
     * @param Category $category
     * @return void
     */
    public function deleted(Category $category): void
    {
        $postList = $category->postList();
        $postList->delete();
        $postList->detach();

        Cache::forget('masterList');
        Cache::forget('productCategoryList');
        Cache::forget('postCategoryList');
        $this->imageService->delete($category->image);
    }
}
