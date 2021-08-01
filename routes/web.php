<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\HomePage\HomePageController;
use \App\Http\Controllers\Shop\ShopController;
use \App\Http\Controllers\Admin\UsersController;
use \App\Http\Controllers\Admin\PostsController;
use \App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ParsingController;
use App\Http\Controllers\Admin\ChatController;

use Illuminate\Support\Facades\Broadcast;


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

Route::prefix(get_prefix())->group(function () {
    Route::get('/', [HomePageController::class, 'index'])->name('/');
    Route::get('/shop', [ShopController::class, 'index'])->name('shop');

    Route::post('/add_messages_to_chat', [ChatController::class, 'addMessagesToModalChat']);
});


//LOGIN AND REGISTER
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


//ADMIN PANEL
Route::prefix('admin')->middleware(['auth:sanctum', 'verified', 'checkRole'])
    ->group(function () {
        Route::get('/', [UsersController::class, 'showUsers'])->name('admin.users');
        Route::resource('/posts', PostsController::class);
        Route::resource('/products', ProductController::class);
        Route::resource('/category', CategoryController::class);
        Route::resource('/filters', FilterController::class);
        Route::get('/parsing', [ParsingController::class, 'index']);

        Route::post('/check_has_new_message', [ChatController::class, 'checkHasNewMessage']);
        Route::post('/add_messages_to_modal_chat', [ChatController::class, 'addMessagesToModalChat']);
        Route::post('/admin_close_the_problems', [ChatController::class, 'completeChat']);
        Route::post('/add_row_to_chats_list', [ChatController::class, 'addRowToChatsList']);

        Route::get('/chat', [ChatController::class, 'index']);
    });

Broadcast::routes(['middleware' => ['auth:sanctum', 'verified',]]);

