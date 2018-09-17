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
        $newsSources = NewsSource::all(['id', 'user_id', 'name', 'slug', 'url', 'logo_url', 'status'])->toArray();

        $this->info('----------------------------------');
        $this->info('Current News Sources:'.sizeof($newsSources));
        $this->info('----------------------------------');

        $headers = ['ID', 'User ID', 'Name', 'Slug', 'Url', 'Logo', 'Status'];

        $this->table($headers, $newsSources);
    }
}
