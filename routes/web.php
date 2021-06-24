<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\HomePage\HomePageController;
use \App\Http\Controllers\Admin\UsersController;
use \App\Http\Controllers\Admin\PostsController;

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

Route::get('/', [HomePageController::class, 'index'])->name('/');


//LOGIN AND REGISTER
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


//ADMIN PANEL
Route::middleware(['auth:sanctum', 'verified', 'checkRole'])->prefix('admin')->group(function () {
    Route::get('/', [UsersController::class, 'showUsers'])->name('admin.users');
    Route::resource('/posts', PostsController::class);
});


