<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OfferDetailController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AdminUserController;


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
 
// Route::get('/', function () {
//     return view('landing.index');
// });
// Route::get('/', 'LandingController@index');
Route::get('/', [LandingController::class, 'index']);

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login', [AdminController::class, 'store'])->name('admin.login');

});

Route::group(['prefix'=> 'admin'], function(){
    Route::resource('admin', AdminController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('designations', DesignationController::class);
    Route::resource('promotions', PromotionController::class);
    Route::resource('units', UnitController::class);
    Route::resource('slides', SlideController::class);
    Route::resource('features', FeatureController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('offers', OfferController::class);
    Route::resource('SetOffers', OfferDetailController::class);
    Route::resource('tags', TagController::class);
    Route::resource('products', ProductController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('admin-user', AdminUserController::class);
    Route::get('/search', 'CategoryController@check_category_avalibility');

});
 

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin/home');
})->name('dashboard');


Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('user_dashboard');


