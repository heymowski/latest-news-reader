<?php

namespace Heymowski\LatestNewsReader\Commands;

use Exception;
use Illuminate\Console\Command;
use Heymowski\LatestNewsReader\Models\NewsSource;

class LNR_RemoveNewsSource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'LNR:RemoveNewsSource';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Last News Reader - Remove News Source';

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
        $this->info('Hello, do you want to remove a source?');

        // Print Sources Table
        $this->printSourcesTable('these are the available sources:');

        // Get Source Id
        $newsSourceIdToRemove = $this->ask('Insert the id of the source you want to remove');

        // Try to get model for this id
        try {
            $newsSourceToRemove = NewsSource::find($newsSourceIdToRemove);

            // Correct model
            if ($this->confirm('('.$newsSourceToRemove->name.') Is this the source you want to remove?')) {

                // Removing
                $this->info('Removing : '.$newsSourceToRemove->name);
                $this->info('-----------------------------');

                // Save Changes
                $newsSourceToRemove->delete();

                $this->info('Done');

                // Print results
                $this->printSourcesTable('these are the results:');

                exit;
            }

            $this->info('-----------------------------');
            $this->info('No changes have been made, bye.');
        } catch (Exception $e) {
        }

        // If Ther is no model for id
        $this->info('Wrong Id');
    }

    /**
     * Print Table with Sources.
     */
    protected function printSourcesTable($title)
    {
        $this->info('-----------------------------');

        $this->info($title);

        $headers = ['ID', 'Name', 'Slug', 'Url'];

        $newsSources = NewsSource::all(['id', 'name', 'slug', 'url'])->toArray();

        $this->table($headers, $newsSources);
    }
}
