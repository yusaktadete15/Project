<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\Auth\LoginController;

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
Route::get('/',[HomeController::class, 'index']);
Route::get('/category',[HomeController::class, 'category']);
Route::get('/checkout-success',[HomeController::class, 'checkoutsuccess']);
Route::get('/checkout',[HomeController::class, 'checkout']);
Route::get('/contact',[HomeController::class, 'contact']);
Route::get('/detail-product',[HomeController::class, 'detailproduct']);
Route::get('/product',[HomeController::class, 'product']);
Route::get('/cart',[HomeController::class, 'cart']);

Route::prefix('admin')->middleware('auth','is_admin')->group(function () 
{
	Route::get('/',[HomeController::class, 'home']);

	Route::prefix('user')->group(function ()
	{
		Route::get('/',[UserController::class, 'index']);

		Route::get('/insert', [UserController::class, 'insert']);
		Route::post('/insert', [UserController::class, 'insertAction']);

		Route::get('/edit/{id}', [UserController::class, 'edit']);
		Route::post('/edit/{id}', [UserController::class, 'editAction']);

		Route::post('/delete/{id}', [UserController::class, 'delete']);
	});
	
	Route::prefix('product')->group(function ()
	{
		Route::get('/',[ProductController::class, 'index']);

		Route::get('/insert', [ProductController::class, 'insert']);
		Route::post('/insert', [ProductController::class, 'insertAction']);

		Route::get('/edit/{id}', [ProductController::class, 'edit']);
		Route::post('/edit/{id}', [ProductController::class, 'editAction']);

		Route::post('/delete/{id}', [ProductController::class, 'delete']);
	});

	Route::prefix('order')->group(function ()
	{
		Route::get('/', [OrderController::class, 'index']);

		Route::get('/insert', [OrderController::class, 'insert']);
		Route::post('/insert', [OrderController::class, 'insertAction']);

		Route::post('/delete/{id}', [OrderController::class, 'delete']);

		Route::get('/orderItem/{id}', [OrderItemController::class, 'index']);
		Route::post('/orderItem/{id}', [OrderItemController::class, 'insert']);

		Route::get('/orderItem/edit/{id}', [OrderItemController::class, 'edit']);
		Route::post('/orderItem/edit/{id}', [OrderItemController::class, 'editAction']);

		Route::post('/orderItem/delete/{id}', [OrderItemController::class, 'delete']);

	});
});


Auth::routes();

