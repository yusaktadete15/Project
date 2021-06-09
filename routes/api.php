<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderItemController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('order')->group(function ()
	{
		Route::get('/order_item/{id}', [OrderItemController::class, 'index']);
		Route::post('/order_item/{id}', [OrderItemController::class, 'store']);

		Route::get('/order_item/edit/{id}', [OrderItemController::class, 'edit']);
		Route::put('{order_id}/order_item/{id}', [OrderItemController::class, 'update']);

		Route::delete('{order_id}/order_item/{id}', [OrderItemController::class, 'destroy']);

		Route::get('/order_item/search/{nama}', [OrderItemController::class, 'search']);

	});

	Route::prefix('product')->group(function ()
	{
		Route::get('/',[ProductController::class, 'index']);

		Route::post('/insert', [ProductController::class, 'store']);

		// Route::get('/edit/{id}', [ProductController::class, 'edit']);
		// Route::post('/edit/{id}', [ProductController::class, 'editAction']);

		Route::delete('/delete/{id}', [ProductController::class, 'destroy']);
	});
