<?php

namespace DailyMoon;

use Carbon\Carbon;
use GuzzleHttp\Client;
use DailyMoon\MoonPhase;
use DailyMoon\Lunopia\Moon;

class MoonPhaseRepository {

    /** @var Client */
    private $astroSeekClient;

    /** @var LunopiaClient */
    private $lunopiaClient;

    public function __construct(Client $astroSeekClient, LunopiaClient $lunopiaClient)
    {
        $this->astroSeekClient = $astroSeekClient;
        $this->lunopiaClient = $lunopiaClient;
    }
    
    public function find(): MoonPhase
    {
        $response = $this->astroSeekClient->get('/', [
            'narozeni_city' => 'Paris,+France'
        ]);

        $astroSeekBody = $response->getBody(true);

        $now = Carbon::now();
        $moonRiseAndSetData = $this->lunopiaClient->getMoonRiseAndMoonSet($now);
        $imgUrl = $this->lunopiaClient->getImage($now);
        $ephemerisData = $this->lunopiaClient->getEphemeris($now);

        return MoonPhase::makeMoonPhaseFromApisData($astroSeekBody, $moonRiseAndSetData, $imgUrl, $ephemerisData);
    }
}
