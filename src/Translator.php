<?php

namespace DailyMoon;

class Translator
{
    const TRANSLATION = [];

    /** @var string */
    protected $label;

    public function __construct(string $label)
    {
        $this->label = $label;
    }

    public function __toString(): string
    {
        if (!isset(static::TRANSLATION[$this->label])) {
            return $this->label;
        }

        return static::TRANSLATION[$this->label];
    }

    public function getOriginal()
    {
        return $this->label;
    }
}
