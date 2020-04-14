<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BookEloquentRepository;
use App\Repositories\Contracts\BookInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BookInterface::class, BookEloquentRepository::class);
    }
}
