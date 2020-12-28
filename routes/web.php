<?php

use App\Http\Controllers\AttributeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

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

Route::get('/', array(
    FrontController::class, 'index'
));

Route::get('/category/{id}', array(
    FrontController::class, 'category'
));

Route::get('/product/{id}', array(
    FrontController::class, 'product'
));

Route::post('/addToCart', array(
    FrontController::class, 'addToCart'
));

Route::get('/deleteFromCart/{id}', array(
    FrontController::class, 'removeFromCart'
));

Route::get('/cart', array(
    FrontController::class, 'cart'
));

Route::get('/order', array(
    FrontController::class, 'order'
));

Route::post('/order', array(
    FrontController::class, 'saveOrder'
));

Route::get('/summary/{id}', array(
    FrontController::class, 'summary'
));

Route::prefix('/files')->group(function () {
    Route::delete('/', array(
        DashboardController::class, 'deleteFile'
    ))->middleware('logged');

    Route::get('/{filename}', array(
        FrontController::class, 'file'
    ));
});

Route::get('/login', array(
    AuthController::class, 'showLoginForm'
))
    ->name('login');;

Route::post('/login', array(
    AuthController::class, 'login'
));

Route::get('/logout', array(
    AuthController::class, 'logout'
));

Route::get('/register', array(
    AuthController::class, 'showRegisterForm'

))
    ->name('register');

Route::post('/register', array(
    AuthController::class, 'register'
));

Route::prefix('dashboard')->middleware('logged')->group(function () {
    Route::get('/', array(
        DashboardController::class, 'welcome'
    ));

    Route::prefix('categories')->group(function () {
        Route::get('/{id?}', array(
            CategoryController::class, 'index'
        ));
    });

    Route::prefix('category')->group(function () {
        Route::get('/', array(
            CategoryController::class, 'create'
        ));

        Route::get('/{id}', array(
            CategoryController::class, 'show'
        ));

        Route::get('/{id}/delete', array(
            CategoryController::class, 'delete'
        ));

        Route::post('/{id?}', array(
            CategoryController::class, 'store'
        ));
    });

    Route::get('/attributes', array(
        AttributeController::class, 'index'
    ));

    Route::prefix('attribute')->group(function () {
        Route::get('/', array(
            AttributeController::class, 'create'
        ));

        Route::get('/{id}', array(
            AttributeController::class, 'show'
        ));

        Route::post('/{id?}', array(
            AttributeController::class, 'store'
        ));
    });

    Route::get('/products', array(
        ProductController::class, 'index'
    ));

    Route::prefix('product')->group(function () {
        Route::get('/', array(
            ProductController::class, 'create'
        ));

        Route::get('/{id}', array(
            ProductController::class, 'show'
        ));

        Route::post('/{id?}', array(
            ProductController::class, 'store'
        ));
    });

    Route::get('/orders', array(
        OrderController::class, 'index'
    ));

    Route::prefix('order')->group(function () {
        Route::get('/{id}', array(
            OrderController::class, 'show'
        ));
    });
});
