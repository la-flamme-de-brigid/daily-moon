<?php

namespace DailyMoon\Entities;

use Carbon\Carbon;

class Date
{
    const FORMATTED_MONTH = [
        5 => 'May',
        6 => 'June',
        7 => 'July'
    ];

    /** @var Carbon */
    private $currentDate;

    public function __construct(Carbon $currentDate)
    {
        $this->currentDate = $currentDate;
    }

    public function __toString(): string
    {
        $month = $this->currentDate->format('M.');

        if (isset(self::FORMATTED_MONTH[$this->currentDate->month])) {
            $month = self::FORMATTED_MONTH[$this->currentDate->month];
        }
        
        return $month . $this->currentDate->format(' d, Y');
    }
}
