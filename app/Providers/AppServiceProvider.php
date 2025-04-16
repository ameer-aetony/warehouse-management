<?php

namespace App\Providers;

use App\Interfaces\ItemCategoryInterFace;
use App\Interfaces\ItemInterFace;
use App\Repositories\ItemCategoryRepository;
use App\Repositories\ItemRepository;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
