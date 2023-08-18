<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/products', [ProductController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);

Route::post('/categories', [CategoryController::class, 'create']);
Route::delete('/categories/{id}', [CategoryController::class, 'delete']);

Route::post('/products', [ProductController::class, 'create']);
Route::delete('/products/{id}', [ProductController::class, 'delete']);

Route::get('/products/filter/{category}', [ProductController::class, 'filter']);
Route::get('/products/sort/{by}', [ProductController::class, 'sort']);

