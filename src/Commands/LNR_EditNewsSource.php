<?php

namespace Heymowski\LatestNewsReader\Commands;

use Illuminate\Console\Command;
use Heymowski\LatestNewsReader\Models\NewsSource;

class LNR_EditNewsSource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'LNR:EditNewsSource';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Last News Reader - Edit News Source';

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
        // Hello
        $this->info('Hello, do you want to edit a source?');

        $this->info('these are the available sources:');

        $headers = ['ID', 'Name', 'Slug', 'Url'];

        $newsSources = NewsSource::all(['id', 'name', 'slug', 'url'])->toArray();

        $this->table($headers, $newsSources);

        $newsSourceIdToEdit = $this->ask('Insert the id of the source you want to edit');

        $newsSourceToEdit = NewsSource::find($newsSourceIdToEdit);

        if ($this->confirm('('.$newsSourceToEdit->name.') Is this the source you want to edit?')) {
            $this->info('OK');
            exit;
        }

        $this->info('KO');
    }
}
