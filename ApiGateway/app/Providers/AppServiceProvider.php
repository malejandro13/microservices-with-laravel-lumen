<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\UserEloquentRepository;
use App\Repositories\Contracts\UserInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserInterface::class, UserEloquentRepository::class);
    }
}
