<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ShopsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\WarehousesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\CartsController;
use App\Http\Controllers\Admin\MainOrderController;
use App\Http\Controllers\Admin\EmployeesController;
use App\Http\Controllers\Admin\OrdersToForeigners;
use App\Http\Controllers\Admin\CartsToForeigners;
use App\Http\Controllers\Admin\MainOrderForeignersController;
use App\Http\Controllers\Admin\InkassaController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Http\Livewire\ShowPosts;

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

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth']);

require __DIR__.'/auth.php';
Route::get('/lang/{lang}', function($lang){
    session(['lang' => $lang]);
    return back();
});

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function(){
    
    Route::resource('shops', ShopsController::class);
    Route::get('/shops/order/{id}', [ShopsController::class, 'status'])->name('shops.status');
    Route::get('/shops/inkassa/{id}', [ShopsController::class, 'inkassa'])->name('shops.inkassa');
    Route::group(['middleware' => ['role:Adminstrator']], function () {
        Route::resource('users', UsersController::class);
        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionController::class);
    });
    Route::resource('warehouses', WarehousesController::class);
    Route::resource('products', ProductsController::class);
    Route::resource('orders', OrdersController::class);
    Route::resource('carts', CartsController::class);
    Route::resource('main_orders', MainOrderController::class);
    Route::resource('employees', EmployeesController::class);
    Route::resource('orders_to_foreigners', OrdersToForeigners::class);
    Route::resource('carts_to_foreigners', CartsToForeigners::class);
    Route::resource('mainOrderForeigner', MainOrderForeignersController::class);
    Route::resource('inkassa', InkassaController::class);

});



