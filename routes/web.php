<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Termwind\Components\Raw;

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
//     return view('welcome');
// });

Route::get('/client/index', function(){
    return view('client.layout.index');
});

Route::get('/admin/index', function(){
    return view('admin.layout.index');
});

Route::prefix('admin')->group(function(){

    Route::resource('category', CategoryController::class);

    Route::resource('product', ProductController::class);

    Route::resource('user', UserController::class);
    Route::put('change-status/{user}', [UserController::class, 'changeStatus'])->name('user.change-status');

});

Route::get('/', function () {
    return view('client.home_page');
});
Route::get('/contact-us', function () {
    return view('client.contact-us');
});
Route::get('/product-page', function(){
    return view('client.product-page');
});
Route::get('/product-detail', function(){
    return view('client.product-detail');
});
Route::get('login', function(){
    return view('client.login');
});
Route::get('cart', function(){
    return view('client.cart');
});