<?php

namespace DailyMoon\Lunopia;

class Moon {

    /** @var Ephemeris */
    private $rise;

    /** @var Ephemeris */
    private $set;

    public function __construct(Ephemeris $rise, Ephemeris $set)
    {
        $this->rise = $rise;
        $this->set = $set;
    }

    public function hasSet()
    {
        return $this->set->getHour() !== '--';
    }
