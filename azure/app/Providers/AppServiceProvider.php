<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Database\SqlServerConnector;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('db.connector.sqlsrv', SqlServerConnector::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
