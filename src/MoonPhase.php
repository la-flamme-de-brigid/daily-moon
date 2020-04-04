<?php

namespace DailyMoon;

class MoonPhase {
    
    private $sign;

    public function __construct(string $sign)
    {
        $this->sign = $sign;
    }


    /**
     * Get the value of sign
     */ 
    public function getSign(): string
    {
        return $this->sign;
    }
}
