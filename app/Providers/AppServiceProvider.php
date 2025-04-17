<?php

namespace App\Providers;

use App\Interfaces\ItemCategoryInterFace;
use App\Interfaces\ItemInterFace;
use App\Interfaces\WarehouseInterFace;
use App\Repositories\ItemCategoryRepository;
use App\Repositories\ItemRepository;
use App\Repositories\WarehouseRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ItemCategoryInterFace::class, ItemCategoryRepository::class);
        $this->app->bind(ItemInterFace::class, ItemRepository::class);
        $this->app->bind(WarehouseInterFace::class, WarehouseRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
