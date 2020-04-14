<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthorEloquentRepository;
use App\Repositories\Contracts\AuthorInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthorInterface::class, AuthorEloquentRepository::class);
    }
}
