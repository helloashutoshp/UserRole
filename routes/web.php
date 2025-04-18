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
        Route::get('/logout', [adminController::class, 'logout'])->name('admin-logout');
        Route::get('/create-user', [homeController::class, 'createUser'])->name('add.user');
        Route::post('/create-user', [homeController::class, 'userStore'])->name('store.user');
        Route::get('/edit-user/{id}', [homeController::class, 'userEdit'])->name('edit.user');
        Route::post('/update-user', [homeController::class, 'userUpdate'])->name('update.user');
        Route::get('/delete-user/{id}', [homeController::class, 'destroy'])->name('delete.user');
        Route::get('/create-role', [homeController::class, 'createRole'])->name('add.role');
        Route::post('/store-role', [homeController::class, 'roleStore'])->name('store.role');
        Route::get('/delete-role/{id}', [homeController::class, 'roleDestroy'])->name('delete.role');
        Route::get('/edit-role/{id}', [homeController::class, 'roleEdit'])->name('edit.role');
        Route::post('/update-role', [homeController::class, 'roleUpdate'])->name('update.role');
    });
});










