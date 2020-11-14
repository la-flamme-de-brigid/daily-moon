<?php

namespace DailyMoon\Repositories;

use Carbon\Carbon;
use DailyMoon\API\LunopiaClient;
use DailyMoon\Entities\BackgroundColorOption;
use DailyMoon\Entities\ImageModelOption;
use GuzzleHttp\Client;
use DailyMoon\Entities\MoonPhase;

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
    
    public function find(BackgroundColorOption $backgroundColorOption, ImageModelOption $imageModelOption): MoonPhase
    {
        $response = $this->astroSeekClient->get('/', [
            'narozeni_city' => 'Paris,+France'
        ]);

        $astroSeekBody = $response->getBody(true);

        $now = Carbon::now();
        $moonRiseAndSetData = $this->lunopiaClient->getMoonRiseAndMoonSet($now);
        $imgUrl = $this->lunopiaClient->getImage($now, $backgroundColorOption, $imageModelOption);
        $ephemerisData = $this->lunopiaClient->getEphemeris($now);

        return MoonPhase::makeMoonPhaseFromApisData($astroSeekBody, $moonRiseAndSetData, $imgUrl, $ephemerisData);
    }
}
