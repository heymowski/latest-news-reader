<?php

namespace Heymowski\LatestNewsReader\Commands;

use Illuminate\Console\Command;
use Heymowski\LatestNewsReader\Reader;
use Heymowski\LatestNewsReader\Models\NewsSource;

class LNR_AddNewsSource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'LNR:AddNewsSource';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Last News Reader - Add News Source';

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
        $this->info('Hello, do you want to add a new source?');

        // Insert the url for the new Source
        $sourceUrl = $this->ask('Please, insert the url for the new Source');

        // Create new Reader
        $reader = new Reader();

        // Check If url is correct
        while ($reader->checkUrl($sourceUrl) == false) {
            $this->info("I'm sorry, bad url, try again");
            // Insert the url for the new Source
            $sourceUrl = $this->ask('Please, insert the url for the new Source, or press Ctrl+c to cancel');
        }

        // If URL Is correct
        $this->info('Perfect, the url is correct.');

        // Check if Url is in database
        if (NewsSource::where('url', $sourceUrl)) {
            $this->info('Sorry, url is already in database.');
            exit();
        }

        // Insert the Name for the new Source
        $sourceName = $this->ask('now add a name for the new source');

        // Slug for Source
        $sourceSlug = str_slug($sourceName, '-');

        // Creating new source
        $newNewsSource = new NewsSource([
            'name' => $sourceName,
            'slug' => $sourceSlug,
            'url' => $sourceUrl,
        ]);

        $newNewsSource->save();

        // Source Created
        $this->info('Done, source created.');

        $this->info('----------------------------------');
        $this->info('Current News Sources:');
        $this->info('----------------------------------');

        foreach (NewsSource::all() as $newsSource) {
            $this->info($newsSource->name.' - '.$newsSource->url);
        }
    }
}
