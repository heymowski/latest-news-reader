<?php

namespace Heymowski\LatestNewsReader\Commands\Items;

use Illuminate\Console\Command;
use Heymowski\LatestNewsReader\Reader;
use Heymowski\LatestNewsReader\Models\NewsSource;
use Heymowski\LatestNewsReader\Models\NewsItem;
use Carbon\Carbon;

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
        $newsSources = NewsSource::all();

        // Create new Reader
        $reader = new Reader();

        foreach ($newsSources as $newsSource) {
            $reader->processFeedItems($newsSource);
            //$readedSource = $reader->read($newsSource->url);

            // $items = $readedSource->get_items();

            // foreach ($items as $item) {
            //     $title = $item->get_title();
            //     $description = $item->get_description();
            //     $content = $item->get_content();
            //     $category = $item->get_category();

            //     $categories = '';
            //     if ($item->get_categories() != null) {
            //         foreach ($item->get_categories() as $cat) {
            //             $categories .= $cat->name;
            //         }
            //     }

            //     $author = $item->get_author()->name;
            //     $contributor = $item->get_contributor();

            //     $contributors = '';
            //     if ($item->get_contributors() != null) {
            //         foreach ($item->get_contributors() as $cont) {
            //             $contributors .= $cont->name;
            //         }
            //     }
            //     $authors = '';
            //     if ($item->get_authors() != null) {
            //         foreach ($item->get_authors() as $auth) {
            //             $authors .= $auth->name;
            //         }
            //     }

            //     $copyright = $item->get_copyright();
            //     $date = new Carbon($item->get_date());
            //     $updated_date = new Carbon($item->get_updated_date());
            //     $link = $item->get_link();
            //     $source = $item->get_source();

            //     $newsItem = new NewsItem([
            //         'title' => $title,
            //         'description' => $description,
            //         'content' => $content,
            //         'category' => $category,
            //         'categories' => $categories,
            //         'author' => $author,
            //         'contributor' => $contributor,
            //         'contributors' => $contributors,
            //         'authors' => $authors,
            //         'copyright' => $copyright,
            //         'date' => $date,
            //         'updated_date' => $updated_date,
            //         'link' => $link,
            //         'source' => $source,
            //     ]);

            //     $newsSource->newsItems()->save($newsItem);
            // }
        }
    }
}
