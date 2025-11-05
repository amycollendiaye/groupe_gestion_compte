<?php

namespace App\Providers;

use App\Http\Repositories\CompteRepository;
use App\Http\Repositories\IRepository;
use App\Http\Services\CompteService;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CompteService::class, function ($app) {
        return new CompteService($app->make(IRepository::class));
    });
          $this->app->singleton(IRepository::class, function ($app) {
        return new CompteRepository();
    });
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
