<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ValorationController;
use App\Http\Controllers\AdminRestaurantController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('restaurants', [App\Http\Controllers\HomeController::class, 'restaurantes'])->name('restaurantes');

    Route::controller(RestaurantController::class)->group(function () {
        Route::get('/api/restaurants', 'list')->name('api.restaurants.list');
        Route::get('/api/restaurants/{id}', 'show')->name('api.restaurants.show');
    });

    Route::controller(AdminRestaurantController::class)->group(function () {
        Route::get('/api/admin/restaurants', 'list')->name('api.admin.restaurants.list');
    });

    Route::controller(ValorationController::class)->group(function () {
        Route::post('/api/valorations/store', 'store')->name('api.valorations.store');
    });
});

Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
//Auth::routes();


Route::controller(RestaurantController::class)->group(function () {
    Route::get('/api/restaurants', 'list')->name('api.restaurants.list');
    Route::get('/api/restaurants/{id}', 'show')->name('api.restaurants.show');
});

Route::controller(AdminRestaurantController::class)->group(function () {
    Route::get('/api/admin/restaurants', 'list')->name('api.admin.restaurants.list');
});

Route::controller(ValorationController::class)->group(function () {
    Route::post('/api/valorations/store', 'store')->name('api.valorations.store');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(AdminRestaurantController::class)->group(function () {
    Route::get('/api/admin/restaurants', 'list')->name('api.admin.restaurants.list');
    Route::get('/api/admin/restaurants/{id}', 'show')->name('api.admin.restaurants.show');
    Route::post('/api/admin/restaurants/store', 'store')->name('api.admin.restaurants.store');
});


Route::controller(ValorationController::class)->group(function () {
    Route::post('/api/valorations/store', 'store')->name('api.valorations.store');
});
