<?php

namespace Heymowski\LatestNewsReader;

use Illuminate\Support\ServiceProvider;

class LatestNewsReaderServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        /*
    	 *
    	 * Load Migrations
    	 *
    	 */
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
    }
}
