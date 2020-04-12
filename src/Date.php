<?php

namespace DailyMoon;

use Carbon\Carbon;

class Date
{
    /** @var Carbon */
    private $currentDate;

    public function __construct(Carbon $currentDate)
    {
        $this->currentDate = $currentDate;
    }

    public function __toString(): string
    {
        return $this->currentDate->format('M. d, Y');
    }
}
