<?php

namespace DailyMoon;

use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;

class MoonPhase {

    /** @var string */
    private $phase;

    /** @var string */
    private $illumination;

    /** @var string */
    private $trajectory;

    /** @var Carbon */
    private $rise;

    /** @var Carbon */
    private $set;

    /** @var string */
    private $sign;

    /** @var string */
    private $imgUrl;

    public function __construct(
        string $phase,
        string $illumination,
        string $trajectory,
        Carbon $rise,
        Carbon $set,
        string $sign,
        string $imgUrl
    ) {
        $this->phase = $phase;
        $this->illumination = $illumination;
        $this->trajectory = $trajectory;
        $this->rise = $rise;
        $this->set = $set;
        $this->sign = $sign;
        $this->imgUrl = $imgUrl;
    }

    /**
     * Get the value of phase
     */ 
    public function getPhase()
    {
        return $this->phase;
    }

    /**
     * Get the value of illumination
     */ 
    public function getIllumination()
    {
        return $this->illumination;
    }

    /**
     * Get the value of trajectory
     */ 
    public function getTrajectory()
    {
        return $this->trajectory;
    }

    /**
     * Get the value of rise
     */ 
    public function getRise()
    {
        return $this->rise;
    }

    /**
     * Get the value of set
     */ 
    public function getSet()
    {
        return $this->set;
    }

        /**
     * Get the value of sign
     */ 
    public function getSign(): string
    {
        return $this->sign;
    }

    public static function makeMoonPhaseFromApisData(
        string $astroSeekBody,
        object $moonRiseAndMoonSetData,
        string $imgUrl,
        array $ephemerisData
    ): MoonPhase {
        
        $crawler = new Crawler($astroSeekBody);
        $sign = $crawler->filter('body .dum-znameni tr')->eq(1)->filter('td')->eq(2)->text();


        $riseHour = str_replace('h', ':', $moonRiseAndMoonSetData->LUNE->LEVE);
        $setHour = str_replace('h', ':', $moonRiseAndMoonSetData->LUNE->COUCHE);
        return new self(
            $ephemerisData[0]->PHASE,
            $ephemerisData[0]->ILLUMINATION,
            $ephemerisData[0]->TRAJECTOIRE,
            Carbon::createFromTimeString(
                $riseHour,
                'Europe/Paris'
            ),
            Carbon::createFromTimeString(
                $setHour,
                'Europe/Paris'
            ),
            $sign,
            $imgUrl
        );
    }

    /**
     * Get the value of imgUrl
     */ 
    public function getImgUrl()
    {
        return $this->imgUrl;
    }
}
