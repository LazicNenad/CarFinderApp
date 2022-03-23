<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\CarController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\AdminController;
use \App\Http\Controllers\LogController;
use \App\Http\Controllers\CarAdminController;
use \App\Http\Controllers\UserAdminController;
use \App\Http\Controllers\LocationAdminController;

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
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['loggedIn'])->group(function() {
    Route::middleware(['admin'])->group(function(){
        Route::redirect('/admin', '/admin/index');
        Route::prefix('admin')->group(function() {

            Route::resource('adminCar', CarAdminController::class);

            Route::resource('adminUser', UserAdminController::class);

            Route::resource('location', LocationAdminController::class);

            Route::get('/index', [AdminController::class, 'index'])->name('admin.index');

            Route::get('/log', [LogController::class, 'index'])->name('admin.log');
        });
    });

    Route::resource('cars', CarController::class)->only([
        'create', 'edit'
    ]);

    Route::delete('/cars/images/{id}', [CarController::class, 'deleteImage']);

    Route::put('/users/password/{id}', [UserController::class, 'updatePassword'])->name('users.updatePassword');

    Route::resource('users', UserController::class);

});

Route::resource('cars', CarController::class)->except([
    'create', 'edit'
]);

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/signout', [AuthController::class, 'signout'])->name('signout');

Route::get('/models/{id}', [\App\Http\Controllers\ModelController::class, 'getModels'] );
