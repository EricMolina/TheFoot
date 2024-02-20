<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ValorationController;
use App\Http\Controllers\AdminRestaurantController;
use App\Http\Controllers\FoodtypeController;

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


Route::controller(RestaurantController::class)->group(function () {
    Route::get('/api/restaurants', 'list')->name('api.restaurants.list');
    Route::get('/api/restaurants/{id}', 'show')->name('api.restaurants.show');
});


Route::controller(FoodtypeController::class)->group(function () {
    Route::get('/api/foodtypes', 'list')->name('api.foodtypes.list');
});


Route::controller(AdminRestaurantController::class)->group(function () {
    Route::get('/api/admin/restaurants', 'list')->name('api.admin.restaurants.list');
    Route::get('/api/admin/restaurants/show', 'show')->name('api.admin.restaurants.show');
    Route::post('/api/admin/restaurants/store', 'store')->name('api.admin.restaurants.store');
    Route::delete('/api/admin/restaurants/', 'destroy')->name('api.admin.restaurants.destroy');
    Route::put('/api/admin/restaurants/', 'update')->name('api.admin.restaurants.update');
    Route::delete('/api/admin/restaurants/images/', 'destroy_image')->name('api.admin.restaurants.images.destroy_image');
    Route::post('/api/admin/restaurants/images/', 'attach_image')->name('api.admin.restaurants.images.attach_image');

    Route::get('/crud/restaurants/', 'index')->name('crud.restaurants');
});


Route::controller(ValorationController::class)->group(function () {
    Route::post('/api/valorations/store', 'store')->name('api.valorations.store');
});
