<?php

namespace Heymowski\LatestNewsReader\Commands\Sources;

use Illuminate\Console\Command;
use Heymowski\LatestNewsReader\Reader;
use Heymowski\LatestNewsReader\Models\NewsSource;

class LNR_GetNewsSource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'LNR-Sources:GetNewsSource';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Last News Reader - Get News Source';

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
        $this->info('----------------------------------');
        $this->info('Current News Sources:');
        $this->info('----------------------------------');

        $headers = ['ID', 'Name', 'Slug', 'Url'];

        $newsSources = NewsSource::all(['id', 'name', 'slug', 'url'])->toArray();

        $this->table($headers, $newsSources);
    }
}
