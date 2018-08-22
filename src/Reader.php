<?php

namespace Heymowski\LatestNewsReader;

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
}
