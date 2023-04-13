<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CartRepository;
use App\Repositories\ShopRepository;
use App\Repositories\ProductRepository;
use App\Repositories\WarehouseRepository;
use App\Repositories\InkassaRepository;
use App\Repositories\MainOrderRepository;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\ShopRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\WarehouseRepositoryInterface;
use App\Repositories\Interfaces\InkassaRepositoryInterface;
use App\Repositories\Interfaces\MainOrderRepositoryInterface;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);        
        $this->app->bind(ShopRepositoryInterface::class, ShopRepository::class);        
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);        
        $this->app->bind(WarehouseRepositoryInterface::class, WarehouseRepository::class);        
        $this->app->bind(InkassaRepositoryInterface::class, InkassaRepository::class);        
        $this->app->bind(MainOrderRepositoryInterface::class, MainOrderRepository::class);        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
