<?php

namespace App\Providers;

use App\Interfaces\InTransactionInterface;
use App\Interfaces\ItemCategoryInterface;
use App\Interfaces\ItemInterFace;
use App\Interfaces\OutTransactionInterface;
use App\Interfaces\WarehouseInterface;
use App\Interfaces\WarehouseTransactionInterface;
use App\Interfaces\WarehouseTransactionTypeInterface;
use App\Repositories\InTransactionRepository;
use App\Repositories\ItemCategoryRepository;
use App\Repositories\ItemRepository;
use App\Repositories\OutTransactionRepository;
use App\Repositories\WarehouseRepository;
use App\Repositories\WarehouseTransactionRepository;
use App\Repositories\WarehouseTransactionTypeRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ItemCategoryInterface::class, ItemCategoryRepository::class);
        $this->app->bind(ItemInterFace::class, ItemRepository::class);
        $this->app->bind(WarehouseInterface::class, WarehouseRepository::class);
        $this->app->bind(WarehouseTransactionTypeInterface::class, WarehouseTransactionTypeRepository::class);
        $this->app->bind(WarehouseTransactionInterface::class, WarehouseTransactionRepository::class);
        $this->app->bind(InTransactionInterface::class, InTransactionRepository::class);
        $this->app->bind(OutTransactionInterface::class, OutTransactionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
