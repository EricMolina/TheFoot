<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ValorationController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AdminRestaurantController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ManagerRestaurantController;
use App\Mail\RestaurantChanged;
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

Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

//Protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    //Ruta default, los restaurantes
    Route::get('/', function () {
        return view('search');
    });
    //Route::get('restaurants', [App\Http\Controllers\HomeController::class, 'restaurantes'])->name('restaurantes');

    Route::controller(RestaurantController::class)->group(function () {
        
        Route::get('/api/restaurants', 'list')->name('api.restaurants.list');
        Route::get('/api/restaurants/{id}', 'show')->name('api.restaurants.show');
    });
    
    Route::controller(ValorationController::class)->group(function () {
        Route::get('/restaurants/{restaurant}/valorations/create', 'create')->name('valorations.create');
        Route::post('/api/valorations/store', 'store')->name('api.valorations.store');
    });

    Route::controller(FoodtypeController::class)->group(function () {
        Route::get('/api/foodtypes', 'list')->name('api.foodtypes.list');
    });
});

Route::middleware(['manager'])->group(function () {
    Route::controller(ManagerRestaurantController::class)->group(function () {
        Route::get('/api/manager/restaurants', 'list')->name('api.manager.restaurants.list');
        Route::get('/api/manager/restaurants/show', 'show')->name('api.manager.restaurants.show');
        Route::post('/api/manager/restaurants/store', 'store')->name('api.manager.restaurants.store');
        Route::delete('/api/manager/restaurants/', 'destroy')->name('api.manager.restaurants.destroy');
        Route::put('/api/manager/restaurants/', 'update')->name('api.manager.restaurants.update');
        Route::delete('/api/manager/restaurants/images/', 'destroy_image')->name('api.manager.restaurants.images.destroy_image');
        Route::post('/api/manager/restaurants/images/', 'attach_image')->name('api.manager.restaurants.images.attach_image');

        Route::get('/my/restaurants/', 'index')->name('myrestaurants');
    });
});

Route::middleware(['admin'])->group(function () {
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

    Route::controller(AdminUserController::class)->group(function () {
        Route::get('/api/admin/users/list', 'list')->name('api.admin.users.list');
        Route::post('/api/admin/users/show', 'show')->name('api.admin.users.show');
        Route::delete('/api/admin/users/delete', 'destroy')->name('api.admin.users.destroy');
        Route::post('/api/admin/users/store', 'store')->name('api.admin.users.store');
        Route::put('/api/admin/users/update', 'update')->name('api.admin.users.update');

        Route::get('/api/admin/users/managers', 'managers')->name('api.admin.users.managers');
        Route::get('/crud/users/', 'index')->name('crud.users');
    });
});
//Auth::routes();