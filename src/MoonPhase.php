<?php

namespace DailyMoon;

use Symfony\Component\DomCrawler\Crawler;

class MoonPhase {

    /** @var string */
    private $phase;

    /** @var string */
    private $illumination;

    /** @var string */
    private $trajectory;

    /** @var Ephemeris */
    private $rise;

    /** @var Ephemeris */
    private $set;

    /** @var string */
    private $sign;

    /** @var string */
    private $imgUrl;

    public function __construct(
        string $phase,
        string $illumination,
        string $trajectory,
        Ephemeris $rise,
        Ephemeris $set,
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

    
    /**
     * Get the value of imgUrl
     */ 
    public function getImgUrl()
    {
        return $this->imgUrl;
    }

    public function hasSet()
    {
        return $this->set->getHour() !== '--';
    }

    public static function makeMoonPhaseFromApisData(
        string $astroSeekBody,
        object $moonRiseAndMoonSetData,
        string $imgUrl,
        array $ephemerisData
    ): MoonPhase {
        
        $crawler = new Crawler($astroSeekBody);
        $sign = $crawler->filter('body .dum-znameni tr')->eq(1)->filter('td')->eq(2)->text();

        return new self(
            $ephemerisData[0]->PHASE,
            $ephemerisData[0]->ILLUMINATION,
            $ephemerisData[0]->TRAJECTOIRE,
            new Ephemeris($moonRiseAndMoonSetData->LUNE->LEVE),
            new Ephemeris($moonRiseAndMoonSetData->LUNE->COUCHE),
            $sign,
            $imgUrl
        );
    }
}
