<?php

namespace DailyMoon;

use GuzzleHttp\Client;
use DailyMoon\MoonPhase;

class MoonPhaseRepository {

    /** @var Client */
    private $astroSeekClient;

    /** @var LunopiaClient */
    private $lunopiaClient;

    /** @var CrawlerFactory */
    private $crawlerFactory;

    public function __construct(Client $astroSeekClient, LunopiaClient $lunopiaClient, CrawlerFactory $crawlerFactory)
    {
        $this->astroSeekClient = $astroSeekClient;
        $this->lunopiaClient = $lunopiaClient;
        $this->crawlerFactory = $crawlerFactory;
    }
    
    public function find(): MoonPhase
    {
        $response = $this->astroSeekClient->get('/', [
            'narozeni_city' => 'Paris,+France'
        ]);

        $body = $response->getBody(true);

        $this->lunopiaClient->getMoonRiseAndMoonSet();

        return $this->makeMoonPhase($body);
    }

    private function makeMoonPhase(string $body): MoonPhase
    {
        
        $crawler = $this->crawlerFactory::make($body);
        $sign = $crawler->filter('body .dum-znameni tr')->eq(1)->filter('td')->eq(2)->text();

        return new MoonPhase($sign);
    }
}
