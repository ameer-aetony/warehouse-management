<?php

namespace App\Providers;

use App\Interfaces\ItemCategoryInterFace;
use App\Repositories\ItemCategoryRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ItemCategoryInterFace::class, ItemCategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
