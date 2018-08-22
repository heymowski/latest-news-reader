<?php

namespace Heymowski\LatestNewsReader\Commands;

use Exception;
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

        // Print Sources Table
        $this->printSourcesTable('these are the available sources:');

        // Get Source Id
        $newsSourceIdToEdit = $this->ask('Insert the id of the source you want to edit');

        // Try to get model for this id
        try {
            $newsSourceToEdit = NewsSource::find($newsSourceIdToEdit);

            // Correct model
            if ($this->confirm('('.$newsSourceToEdit->name.') Is this the source you want to edit?')) {

                // Name
                $this->info('Name : '.$newsSourceToEdit->name);
                $this->info('-----------------------------');
                // Change name?
                if ($this->confirm('Do you wish to change the name?')) {
                    $newsSourceToEdit->name = $this->ask('Insert new Name');
                    $newsSourceToEdit->slug = str_slug($newsSourceToEdit->name, '-');
                }

                // URL
                $this->info('Url : '.$newsSourceToEdit->url);
                $this->info('-----------------------------');
                // Change Url?
                if ($this->confirm('Do you wish to change the url?')) {
                    $newsSourceToEdit->url = $this->ask('Insert new Url');
                }

                // Save Changes
                $newsSourceToEdit->save();

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
