<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InterfaceClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StatisController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Termwind\Components\Raw;
use Laravel\Socialite\Facades\Socialite;

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


// Authentication

Route::middleware('guest')->prefix('/')->group(function () {

    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginPost'])->name('loginPost');

    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'registerPost'])->name('registerPost');

    Route::get('login-google', [AuthController::class, 'loginGoogle'])->name('login-google');

    Route::get('google/callback', [AuthController::class, 'loginGoogleCallback'])->name('google-callback');
});

Route::middleware('auth')->get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/client/index', function () {
    return view('client.layout.index');
});

Route::get('/admin/index', function () {
    return view('admin.layout.index');
});

Route::middleware('auth')->prefix('/')->group(function () {

    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::resource('category', CategoryController::class);

        Route::resource('product', ProductController::class);
        Route::put('change-status-product/{product}', [ProductController::class, 'changeStatus'])->name('change-status-product');

        Route::resource('user', UserController::class);
        Route::put('change-status-user/{user}', [UserController::class, 'changeStatus'])->name('change-status-user');

        Route::resource('order', OrderController::class);
        Route::put('change-status-order/{order}', [OrderController::class, 'changeStatus'])->name('change-status-order');

        Route::resource('contact', ContactController::class);

        Route::get('statis', [StatisController::class, 'index'])->name('statis.index');

        Route::resource('comment', CommentController::class);
    });
});

Route::prefix('client')->group(function () {

    Route::get('home-page', [InterfaceClientController::class, 'homePage'])->name('home_page');
    Route::get('products', [InterfaceClientController::class, 'showProducts'])->name('products');
    Route::get('contact-us', [InterfaceClientController::class, 'contactUs'])->name('contact-us');
    Route::get('carts', [InterfaceClientController::class, 'carts'])->name('carts');
    Route::get('product-detail/{id}', [InterfaceClientController::class, 'productDetail'])->name('product-detail');
    Route::post('add-to-cart/{product}', [InterfaceClientController::class, 'addToCart'])->name('addToCart');
    Route::get('remove-item-cart/{id}', [InterfaceClientController::class, 'removeItemCart'])->name('removeItemCart');
    Route::get('order', [InterfaceClientController::class, 'order'])->name('order');
    Route::put('orderDetroy/{order}', [InterfaceClientController::class, 'orderDetroy'])->name('orderDetroy');
    Route::post('contact', [InterfaceClientController::class, 'contactStore'])->name('contactStore');
    Route::post('comment/{id}', [InterfaceClientController::class, 'commentStore'])->name('commentStore');
    Route::get('comment-destroy/{id}', [InterfaceClientController::class, 'commentDestroy'])->name('commentDestroy');
    Route::get('checkout', [InterfaceClientController::class, 'checkout'])->name('checkout');
    Route::post('checkoutAction', [InterfaceClientController::class, 'checkoutAction'])->name('checkoutAction');
});


//login-google - Đường dẫn mở ra màn hình đăng nhập google

// Route::get('login-google', function () {

//     return Socialite::driver('google')->redirect();
// });
