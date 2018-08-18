<?php

namespace Heymowski\LatestNewsReader;

use Heymowski\LatestNewsReader\Lib\SimplePie;
use Heymowski\LatestNewsReader\Lib\SimplePie_Misc;

class Reader
{
    public function init()
    {
        $SimplePie_Misc = new SimplePie_Misc();
        $url = 'http://rss.nytimes.com/services/xml/rss/nyt/HomePage.xml';
        $feed = new SimplePie();
        $feed->set_feed_url($url);
        // $feed->init();
    }
}
