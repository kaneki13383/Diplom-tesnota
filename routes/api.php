<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\LoadAvatarController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserOutputController;

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

// Route::group(['middleware' => 'auth:sanctum'], function(){
//     Route::post('/load-avatar', '\App\Http\Controllers\LoadAvatarController');
// });

Route::post('/load-avatar', [LoadAvatarController::class, 'store']);
Route::post('/changeInfoUser', [UserOutputController::class, 'changeInfoUser']);
Route::post('/dataOrder', [UserOutputController::class, 'dataOrder']);
Route::get('/menu_all', [MenuController::class, 'allMenu']);
Route::get('/type_all', [TypeController::class, 'all']);
Route::post('/create_product', [MenuController::class, 'createProduct']);
Route::delete('/delete_product{id}', [MenuController::class, 'delete']);
Route::get('/product/{id}', [MenuController::class, 'find']);
Route::post('/edit_product', [MenuController::class, 'edit']);

Route::get('/cart/all', [CartController::class, 'all']);
Route::post('/cart/{id}', [CartController::class, 'add']);
Route::post('/cart_delete/{id}', [CartController::class, 'delete']);

Route::get('/reviews', [ReviewController::class, 'all']);
Route::post('/add_review', [ReviewController::class, 'add']);

Route::post('/create_order', [OrderController::class, 'createOrder']);
Route::get('/orders', [OrderController::class, 'all']);