<?php

namespace DailyMoon;

use GuzzleHttp\Client;
use DailyMoon\MoonPhase;

class MoonPhaseRepository {

    /** @var Client */
    private $astroSeekClient;

    /** @var CrawlerFactory */
    private $crawlerFactory;

    public function __construct(Client $astroSeekClient, CrawlerFactory $crawlerFactory)
    {
        $this->astroSeekClient = $astroSeekClient;
        $this->crawlerFactory = $crawlerFactory;
    }
    
    public function find(): MoonPhase
    {
        $response = $this->astroSeekClient->get('/', [
            'narozeni_city' => 'Paris,+France'
        ]);

        $body = $response->getBody(true);

        return $this->makeMoonPhase($body);
    }

    private function makeMoonPhase(string $body): MoonPhase
    {
        
        $crawler = $this->crawlerFactory::make($body);
        $sign = $crawler->filter('body .dum-znameni tr')->eq(1)->filter('td')->eq(2)->text();

        return new MoonPhase($sign);
    }
}
