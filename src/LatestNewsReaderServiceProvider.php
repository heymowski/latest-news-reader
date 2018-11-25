<?php

namespace Heymowski\LatestNewsReader;

use Illuminate\Support\ServiceProvider;

//Commands
use Heymowski\LatestNewsReader\Commands\LNR_Console;
//Sources
use Heymowski\LatestNewsReader\Commands\Sources\LNR_AddNewsSource;
use Heymowski\LatestNewsReader\Commands\Sources\LNR_EditNewsSource;
use Heymowski\LatestNewsReader\Commands\Sources\LNR_GetNewsSource;
use Heymowski\LatestNewsReader\Commands\Sources\LNR_RemoveNewsSource;
// Items
use Heymowski\LatestNewsReader\Commands\Items\LNR_ReadAll;

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
            	// Console
            	LNR_Console::class,
                // Sources
                LNR_AddNewsSource::class,
                LNR_EditNewsSource::class,
                LNR_GetNewsSource::class,
                LNR_RemoveNewsSource::class,

                // Items
                LNR_ReadAll::class,
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
