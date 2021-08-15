<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use \App\Http\Controllers\Admin\ChatController;
use \App\Http\Controllers\VueAdmin\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/message', [MessageController::class, 'broadcast']);
Route::post('/admin_send_message', [ChatController::class, 'broadcast']);

Route::get('/getComments/{user_id}', [ChatController::class, 'getComments']);

Route::middleware(['auth:sanctum', 'verified', 'checkRole'])
       ->resource('/products', ProductController::class);
