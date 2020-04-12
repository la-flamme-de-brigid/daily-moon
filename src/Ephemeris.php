<?php

namespace DailyMoon;

use Carbon\Carbon;

class Ephemeris {
    
    /** @var string */
    private $hour;

    public function __construct(string $hour)
    {
        $this->hour = $hour;
    }

    /**
     * Get the value of hour
     */ 
    public function getHour()
    {
        return $this->hour;
    }

    public function __toString()
    {
        if ($this->hour === '--') {
            return '--';
        }

        $hour = Carbon::createFromTimeString(
            $setHour = str_replace('h', ':', $this->hour),
            'Europe/Paris'
        );

        return $hour->format('h:i A');
    }
}