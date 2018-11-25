<?php

namespace Heymowski\LatestNewsReader;

use Heymowski\LatestNewsReader\Models\NewsSource;
use Heymowski\LatestNewsReader\Models\NewsItem;
use Carbon\Carbon;
use SimplePie;

class Reader
{
    /**
     * Check if url is correct.
     */
    public function checkUrl($url)
    {
        $feed = $this->loadUrl($url);

        if ($feed->error()) {
            return false;
        }

        return true;
    }

    /**
     * Read fedd url.
     */
    public function read($url)
    {
        $feed = $this->loadUrl($url);

        return $feed;
    }

    /**
     * Load url and read the feed.
     */
    protected function loadUrl($url)
    {
        $feed = new SimplePie();

        $feed->set_feed_url($url);

        $feed->enable_cache(false);

        $feed->init();

        $feed->handle_content_type();

        return $feed;
    }

    /**
     * Process Feed Items.
     */
    public function processFeedItems(NewsSource $newsSource)
    {
        $feed = $this->loadUrl($newsSource->url);
        
        if ($feed->error()) {
            $newsSource->status = 0;
            $newsSource->save();
            return null;
        }

        $items = $feed->get_items();

        foreach ($items as $item) {

        	$title = $item->get_title();
            $description = $item->get_description();
            $content = $item->get_content();
            $category = $item->get_category();

            $image_url = $this->getImage($item);

            if($image_url === null)
            {
            	$image_url = $newsSource->logo_url;
            }
            

            $categories = '';
            if ($item->get_categories() != null) {
                foreach ($item->get_categories() as $cat) {
                    $categories .= $cat->term.', ';
                }
            }

            $author = $item->get_author()->name;
            $contributor = $item->get_contributor();

            $contributors = '';
            if ($item->get_contributors() != null) {
                foreach ($item->get_contributors() as $cont) {
                    $contributors .= $cont->name.', ';
                }
            }
            $authors = '';
            if ($item->get_authors() != null) {
                foreach ($item->get_authors() as $auth) {
                    $authors .= $auth->name.', ';
                }
            }

            $copyright = $item->get_copyright();
            $date = new Carbon($item->get_date());
            $updated_date = new Carbon($item->get_updated_date());
            $link = $item->get_link();
            $source = $item->get_source();

            if ($this->checkIfItemIsNotInDB($title, $date, $newsSource->id)) {
                $newsItem = new NewsItem([
                    'title' => $this->checkNotNullData($title),
                    'description' => $this->checkNotNullData($description),
                    'content' => $this->checkNotNullData($content),
                    'image_url' => $image_url,
                    'category' => $this->checkNotNullData($category),
                    'categories' => $this->checkNotNullData($categories),
                    'author' => $this->checkNotNullData($author),
                    'contributor' => $this->checkNotNullData($contributor),
                    'contributors' => $this->checkNotNullData($contributors),
                    'authors' => $this->checkNotNullData($authors),
                    'copyright' => $this->checkNotNullData($copyright),
                    'date' => $this->checkNotNullData($date),
                    'updated_date' => $this->checkNotNullData($updated_date),
                    'link' => $this->checkNotNullData($link),
                    'source' => $this->checkNotNullData($source),
                ]);

                $newsSource->newsItems()->save($newsItem);
            }
        }
    }

    /**
     *
     * Block comment
     *
     */
    public function getImage($item)
	{
		$image = $item->get_enclosure();

        if($image)
        {
        	return $image->link;
        
        }else{

        	$search = '/(https?:\/\/.*\.(?:png|jpg))/i';
		
			$match = preg_match($search, $item->get_content(), $matches);
			
			if ($match === 1) {
			
				return $matches[0];
			
			}

			return null;
        }
	}
    
    /**
     * getLogoUrl
     */
    public function getLogoUrl($url)
    {
        $feed = $this->loadUrl($url);

        if ($feed->get_image_url() != null) {
        	return $feed->get_image_url();
        }

        return null;
    }
    

    /**
     * Check If Item is not in DB.
     */
    protected function checkIfItemIsNotInDB($title, $date, $newsSourceId)
    {
        $item = NewsItem::where('title', $title)
                        ->where('date', $date)
                        ->where('news_source_id', $newsSourceId)
                        ->first();

        if ($item == null) {
            return 'true';
        }

        return false;
    }

    /**
     * Check that data is not null.
     */
    protected function checkNotNullData($data)
    {
        if ($data == null) {
            return 'NULL';
        }

        return $data;
    }
}
