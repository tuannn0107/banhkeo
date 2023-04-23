<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\CheckoutController;
use App\Http\Controllers\Home\CmsController;
use App\Http\Controllers\Home\ContactController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\LocalizationController;
use App\Http\Controllers\Home\PageController;
use App\Http\Controllers\Home\PostController;
use App\Http\Controllers\Home\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('', [HomeController::class, 'index']);

Route::get('{productCategory}', [ProductController::class, 'index']);
Route::get('{productCategory}/{post:slug}', [ProductController::class, 'detail']);

Route::get('{postCategory}', [PostController::class, 'index']);
Route::get('{postCategory}/{post:slug}', [PostController::class, 'detail']);

Route::get('{contactTranslation}', [ContactController::class, 'index']);

Route::get('{pageSlug}', [PageController::class, 'index']);

Route::resource('{cartTranslation}', CartController::class)->parameter('{cartTranslation}', 'cart');
Route::post('{cartTranslation}/{cart}', [CartController::class, 'store']);

Route::get('{checkoutTranslation}', [CheckoutController::class, 'index']);
Route::post('{checkoutTranslation}', [CheckoutController::class, 'store']);

Route::post('cms', CmsController::class);
Route::post('contact', [ContactController::class, 'store']);

Route::get('{locale}', [LocalizationController::class, 'set'])->name('locale');

Route::get('{provider}/login', [LoginController::class, 'redirectToProvider'])->name('social');
Route::get('{provider}/callback', [LoginController::class, 'handleProviderCallback']);

Auth::routes([
    'register' => cache()->get('config')->enable_registration ?? false,
    'reset' => cache()->get('config')->enable_forgotten_password ?? false,
    'verify' => true
]);

Route::fallback(function () {
    return redirect('/');
});
