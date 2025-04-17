<?php

use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\basicController;
use App\Http\Controllers\front\authController;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => '/admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [adminController::class, 'index'])->name('admin-login');
        Route::post('/authenticate', [adminController::class, 'authenticate'])->name('admin-authenticate');
    });
    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [homeController::class, 'index'])->name('admin-dashboard');
        Route::get('/logout', [homeController::class, 'logout'])->name('admin-logout');

    
    });
});










