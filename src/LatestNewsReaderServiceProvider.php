<?php

namespace Heymowski\LatestNewsReader;

use Illuminate\Support\ServiceProvider;

//Commands
use Heymowski\LatestNewsReader\Commands\LNR_AddNewsSource;

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

        /*
         *
         * Load Commands
         *
         */

        if ($this->app->runningInConsole()) {
            $this->commands([
                LNR_AddNewsSource::class,
                //BarCommand::class,
            ]);
        }
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
    }
}
