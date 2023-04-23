<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ConfigurationController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VisitorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('', function () {
    return to_route('contact.index');
});

Route::resource('role', RoleController::class);
Route::resource('permission', PermissionController::class);
Route::resource('user', UserController::class);

Route::resource('cms', CmsController::class)->parameter('cms', 'configuration');
Route::resource('profile', ProfileController::class)->parameter('profile', 'user');
Route::resource('change-password', PasswordController::class)->parameter('change-password', 'user');
Route::resource('configuration', ConfigurationController::class);
Route::post('configuration/system', [ConfigurationController::class, 'storeSystem'])->name('configuration.system');
Route::resource('visitor', VisitorController::class);
Route::resource('contact', ContactController::class);
Route::resource('category', CategoryController::class);
Route::post('category/order', [CategoryController::class, 'order']);
Route::post('category/master', [CategoryController::class, 'master'])->name('category.master');
Route::resource('comment', CommentController::class);
Route::resource('order', OrderController::class);
Route::resource('post', PostController::class);
Route::resource('image', ImageController::class);
Route::post('image/order', [ImageController::class, 'order']);
Route::post('image/delete', [ImageController::class, 'delete']);
Route::resource('seo', SeoController::class);
Route::post('generate-slug', [SeoController::class, 'generateSlug']);

Route::view('dropzone', 'admin.sample.dropzone');
