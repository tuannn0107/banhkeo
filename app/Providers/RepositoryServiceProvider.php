<?php

namespace App\Providers;

use App\Repositories\Interfaces\VisitorRepositoryInterface;
use App\Repositories\VisitorRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(VisitorRepositoryInterface::class, VisitorRepository::class);
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
