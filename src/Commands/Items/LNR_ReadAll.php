<?php

namespace Heymowski\LatestNewsReader\Commands\Items;

use Illuminate\Console\Command;
use Heymowski\LatestNewsReader\Reader;
use Heymowski\LatestNewsReader\Models\NewsSource;

class LNR_ReadAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'LNR-Items:ReadAll';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Last News Reader - Read All News';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $newsSources = NewsSource::where('status', 1)->get();

        // Create new Reader
        $reader = new Reader();

        foreach ($newsSources as $newsSource) {
            $reader->processFeedItems($newsSource);
        }

        $this->info('Done');
    }
}
