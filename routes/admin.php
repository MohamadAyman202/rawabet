<?php

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\Auth\LoginController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MeasuringUnitController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubscriptionController;
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
        Route::prefix('admin')->group(function () {
            Route::middleware('guest:admin')->group(function () {
                Route::match(['get', 'post'], 'login', [LoginController::class, 'login'])->name('login');
            });

            Route::middleware('auth:admin')->group(function () {
                Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

                Route::resources([
                    'category'          => CategoryController::class,
                    'sub_category'      => SubCategoryController::class,
                    'measuring_units'   => MeasuringUnitController::class,
                    'products'          => ProductController::class,
                    'subscriptions'     => SubscriptionController::class,
                    'customers'         => CustomerController::class,
                    'roles'             => RoleController::class,
                    'admins'            => AdminController::class,
                    'slider'            => SliderController::class,
                ]);

                Route::get('/get_data/{id}', [ProductController::class, 'get_sub_category'])->name('get_data');

                Route::controller(CustomerController::class)->group(function () {
                    Route::get('city_data/{country_id}/{state_id}', 'city_data')->name('city_data');
                    Route::get('state_data/{id}',  'state_data')->name('state_data');
                });

                Route::controller(SettingController::class)->group(function () {
                    Route::get('setting',  'index')->name('setting.index');
                    Route::patch('setting/update/{id}', 'update')->name('setting.update');
                });
                Route::post('logout', [LoginController::class, 'logout'])->name('logout');
            });
        });
    }
);
