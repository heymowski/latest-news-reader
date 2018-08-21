<?php

namespace Heymowski\LatestNewsReader;

use Illuminate\Support\ServiceProvider;

//Commands
use Heymowski\LatestNewsReader\Commands\LNR_AddNewsSource;
use Heymowski\LatestNewsReader\Commands\LNR_EditNewsSource;
use Heymowski\LatestNewsReader\Commands\LNR_RemoveNewsSource;

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
                LNR_EditNewsSource::class,
                LNR_RemoveNewsSource::class,
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
