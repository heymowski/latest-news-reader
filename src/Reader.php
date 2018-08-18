<?php

namespace Heymowski\LatestNewsReader;

use SimplePie;

class Reader
{
    public function init()
    {
        $reader = new SimplePie();

        // $url = 'http://rss.nytimes.com/services/xml/rss/nyt/HomePage.xml';
        $url = 'http://ep00.epimg.net/rss/elpais/portada.xml';

        $reader->set_feed_url($url);

        $reader->enable_cache(false);

        $reader->init();

        $reader->handle_content_type();

        return $reader->get_items();
    }
}
