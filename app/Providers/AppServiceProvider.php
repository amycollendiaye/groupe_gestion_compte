<?php

namespace App\Providers;

use App\Http\Repositories\ClientRepository;
use App\Http\Repositories\CompteRepository;
use App\Http\Repositories\IRepository;
use App\Http\Repositories\IRepositoryfirst;
use App\Http\Repositories\UserRepository;
use App\Http\Services\ClientService;
use App\Http\Services\CompteService;
use App\Http\Services\UserService;
use App\Models\Client;
use App\Models\Compte;
use App\Models\User;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CompteService::class, function ($app) {
            return new CompteService(
                $app->make(IRepository::class),
                $app->make(UserService::class),
                $app->make(ClientService::class),

            );
        });
        $this->app->singleton(IRepository::class, function ($app) {
            return new CompteRepository($app->make(Compte::class));
        });
       $this->app->when(UserService::class)
          ->needs(IRepositoryfirst::class)
          ->give(function($app){
              return new UserRepository($app->make(User::class));
          });
        
        $this->app->when(ClientService::class)
          ->needs(IRepositoryfirst::class)
          ->give(function($app){
              return new ClientRepository($app->make(Client::class));
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
