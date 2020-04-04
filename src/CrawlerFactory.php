<?php

namespace DailyMoon;

use Symfony\Component\DomCrawler\Crawler;

class CrawlerFactory {

    public static function make(string $html)
    {
        return new Crawler($html);
    }
}
