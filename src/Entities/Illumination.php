<?php

namespace DailyMoon\Entities;

class Illumination
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        $valueWithPoint = str_replace('.', ',', $this->value);
        return str_replace(' %', '%', $valueWithPoint);
    }
}
