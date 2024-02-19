<?php

use Illuminate\Support\Facades\Route;
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


Route::controller(RestaurantController::class)->group(function () {
    Route::get('/api/restaurants', 'list')->name('api.restaurants.list');
    Route::get('/api/restaurants/{id}', 'show')->name('api.restaurants.show');

    /*     Route::get('cursos', 'index')->name('cursos.index');
    Route::get('cursos/{id}', 'show')->name('cursos.show');
    Route::delete('cursos/{curso}', 'destroy')->name('cursos.destroy');
    Route::put('cursos/{curso}', 'update')->name('cursos.update');
    Route::get('cursos/create', 'create')->name('cursos.create');
    Route::get('cursos/edit/{id}', 'edit')->name('cursos.edit');
    Route::post('cursos/store', 'store')->name('cursos.store'); */
});


Route::controller(AdminRestaurantController::class)->group(function () {
    Route::get('/api/admin/restaurants', 'list')->name('api.admin.restaurants.list');
    Route::get('/api/admin/restaurants/{id}', 'show')->name('api.admin.restaurants.show');
    Route::post('/api/admin/restaurants/store', 'store')->name('api.admin.restaurants.store');
    Route::delete('/api/admin/restaurants/{id}', 'destroy')->name('api.admin.restaurants.destroy');
    Route::put('/api/admin/restaurants/{id}', 'update')->name('api.admin.restaurants.update');
    
    Route::get('/api/admin/formejemplo/{id}', 'formejemplo')->name('api.admin.formejemplo');
});


Route::controller(ValorationController::class)->group(function () {
    Route::post('/api/valorations/store', 'store')->name('api.valorations.store');
});
