<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserAuthController;
use App\Http\Controllers\API\WarehouseController;
use App\Http\Controllers\API\ShopsController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\InkassaOrderController;
use App\Http\Controllers\API\MainController;

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

Route::middleware('auth:api')->group(function()
{

Route::apiResource('shop', ShopsController::class);
Route::apiResource('warehouses', WarehouseController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('orders', InkassaOrderController::class);
Route::post('statistics', [MainController::class, 'statistics'])->name('statistics');
Route::post('groupByInkassa', [MainController::class, 'groupByInkassa'])->name('groupByInkassa');
Route::post('update_user', [UserAuthController::class, 'update_user']);
Route::post('inkassa/search', [MainController::class, 'inkassa_search']);
});
 

Route::post('register', [UserAuthController::class, 'register']);
Route::post('login', [UserAuthController::class, 'login']);


