<?php

namespace App\Providers;

use App\Enums\MasterType;
use App\Models\Category;
use App\Models\Configuration;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Seo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            $config = cache()->rememberForever('config', function () {
                return (object)Configuration::pluck('content', 'name')->toArray();
            });

            View::share('config', $config);

            $cmsList = cache()->rememberForever('cmsList', function () {
                return Configuration::whereType('cms')->get();
            });

            View::share('cmsList', $cmsList);

            $masterList = cache()->rememberForever('masterList', function () {
                return Category::masterList()->active()->get();
            });

            View::share('masterList', $masterList);

            $productCategoryList = cache()->rememberForever('productCategoryList', function () {
                return Category::whereSlug(MasterType::PRODUCT->value)->firstOrFail()->descendantList();
            });

            View::share('productCategoryList', $productCategoryList);

            $postCategoryList = cache()->rememberForever('postCategoryList', function () {
                return Category::whereSlug(MasterType::POST->value)->firstOrFail()->descendantList();
            });

            View::share('postCategoryList', $postCategoryList);

            $pageList = cache()->rememberForever('pageList', function () {
                return Category::whereSlug(MasterType::PAGE->value)->firstOrFail()->descendantPostList()->get();
            });

            View::share('pageList', $pageList);

            $roleList = cache()->rememberForever('roleList', function () {
                return Role::all();
            });

            View::share('roleList', $roleList);

            $permissionList = cache()->rememberForever('permissionList', function () {
                return Permission::all();
            });

            View::share('permissionList', $permissionList);

            $seo = Seo::whereCanonical(last(request()->segments()))->first();
            if ($seo) {
                View::share('seo', $seo);
            }
        } catch (\Exception $e) {
            // NOP
        }
    }
}
