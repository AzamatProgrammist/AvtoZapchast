<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ShopsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\WarehousesController;
use App\Http\Controllers\Admin\ProductsController;


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

Route::get('/', function () {
    return view('admin.dashboard');
})->middleware(['auth']);

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function(){
    
    Route::resource('shops', ShopsController::class);
    Route::resource('users', UsersController::class);
    Route::resource('warehouses', WarehousesController::class);
    Route::resource('products', ProductsController::class);

});