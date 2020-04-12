<?php

namespace DailyMoon;

use Symfony\Component\DomCrawler\Crawler;

class MoonPhase {

    /** @var Phase */
    private $phase;

    /** @var string */
    private $illumination;

    /** @var Trajectory */
    private $trajectory;

    /** @var Ephemeris */
    private $rise;

    /** @var Ephemeris */
    private $set;

    /** @var Sign */
    private $sign;

    /** @var string */
    private $imgUrl;

    public function __construct(
        Phase $phase,
        string $illumination,
        Trajectory $trajectory,
        Ephemeris $rise,
        Ephemeris $set,
        Sign $sign,
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
    public function getPhase(): Phase
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
    public function getTrajectory(): Trajectory
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
    public function getSign(): Sign
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
        $labelSign = $crawler->filter('body .dum-znameni tr')->eq(1)->filter('td')->eq(2)->text();

        return new self(
            new Phase($ephemerisData[0]->PHASE),
            $ephemerisData[0]->ILLUMINATION,
            new Trajectory($ephemerisData[0]->TRAJECTOIRE),
            new Ephemeris($moonRiseAndMoonSetData->LUNE->LEVE),
            new Ephemeris($moonRiseAndMoonSetData->LUNE->COUCHE),
            new Sign($labelSign),
            $imgUrl
        );
    }
}
