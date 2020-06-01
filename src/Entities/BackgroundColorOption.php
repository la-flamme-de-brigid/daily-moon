<?php
declare(strict_types=1);

namespace DailyMoon\Entities;

class BackgroundColorOption
{
    /** @var string */
    private $color;

    public function __construct(string $color)
    {
        $this->color = $color;
    }

    public function __toString()
    {
        return $this->color;
    }
}
