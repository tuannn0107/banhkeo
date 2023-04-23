<?php

namespace App\Providers;

use App\Enums\LanguageType;
use App\Enums\MasterType;
use App\Models\Category;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/admin';

    public const LOGIN = '/login';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware(['web', 'auth', 'verified'])
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));
        });

        foreach (trans('slug') as $key => $value) {
            Route::pattern($key . 'Translation', $this->getTranslation($key));
        }

        $productCategoryList = cache()->get('productCategoryList') ?? Category::whereSlug(MasterType::PRODUCT->value)->firstOrFail()->descendantList();
        $postCategoryList = cache()->get('postCategoryList') ?? Category::whereSlug(MasterType::POST->value)->firstOrFail()->descendantList();
        $pageList = cache()->get('pageList') ?? Category::whereSlug(MasterType::PAGE->value)->firstOrFail()->descendantPostList();
        Route::pattern('productCategory', $productCategoryList->pluck('slug')->implode('|'));
        Route::pattern('postCategory', $postCategoryList->pluck('slug')->implode('|'));
        Route::pattern('pageSlug', $pageList->pluck('slug')->implode('|'));

        Route::pattern('locale', collect(LanguageType::cases())->pluck('value')->implode('|'));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    /**
     * Get slug translation
     *
     * @param $slug
     * @return string
     */
    private function getTranslation($slug): string
    {
        $slugList = collect();
        foreach (LanguageType::cases() as $language) {
            $slugList = $slugList->merge(trim(trans('slug.' . $slug, [], $language->value), '/'));
        }

        return $slugList->implode('|');
    }
}
