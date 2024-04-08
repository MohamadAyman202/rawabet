<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Auth::routes();
        Route::middleware('guest')->group(function () {

            Route::match(['get', 'post'], 'login', [LoginController::class, 'login'])->name('login');
            Route::match(['get', 'post'], 'register', [RegisterController::class, 'index'])->name('register');
            Route::controller(RegisterController::class)->group(function () {
                Route::get('customer/city_data/{country_id}/{state_id}', 'city_data')->name('city_data');
                Route::get('customer/state_data/{id}',  'state_data')->name('state_data');
            });

            Route::controller(HomeController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('contact', 'contact')->name('contact');
                Route::post('set_session', 'set_session')->name('set_session');
            });
        });
        Route::middleware('auth')->group(function () {
            Route::controller(HomeController::class)->group(function () {
                Route::get('/home',  'home')->name('home');
                Route::get('subscriptions', 'subscriptions')->name('subscriptions');
                Route::get('category', 'categories')->name('categories');
                Route::get('sub_category/{slug}', 'sub_categories')->name('sub_categories');

                // Start Route Products
                Route::get("product_details/{slug}", 'product_details')->name('product_details');
                Route::get('products/{slug}', 'products')->name('products');
                Route::get('products', 'all_products')->name('all_products');
                Route::get('my_products', 'my_products')->name('my_products');
                Route::get('profile/products/create', 'product_create')->name('product_create');
                Route::post('profile/products/store', 'product_store')->name('product_store');
                Route::get('profile/products/edit/{slug}', 'product_edit')->name('product_edit');
                Route::patch('profile/products/update/{slug}', 'product_update')->name('product_update');
                Route::delete('profile/products/destroy/{slug}', 'product_destroy')->name('product_destroy');
                // End Route Products

                Route::get('contactus', 'contactus')->name('contactus');
                Route::get('profile', 'profile')->name('profile');
                Route::get('invoices', 'invoice')->name('invoice');
                Route::get('setting', 'setting')->name('web.setting');
            });

            Route::get('/get_data/{id}', [ProductController::class, 'get_sub_category'])->name('get_data');
            Route::controller(CustomerController::class)->group(function () {
                Route::get('city_data/{country_id}/{state_id}', 'city_data')->name('city_data');
                Route::get('state_data/{id}',  'state_data')->name('state_data');
            });
        });
    }
);
