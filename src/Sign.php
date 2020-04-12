<?php

namespace DailyMoon;

class Sign
{
    const TRANSLATION = [
        'Aries' => '♈️ Aries',
        'Taurus' => '♉️ Taurus',
        'Gemini' => '♊️ Gemini',
        'Cancer' => '♋️ Cancer',
        'Leo' => '♌️ Leo',
        'Virgo' => '♍️ Virgo',
        'Libra' => '♎️ Libra',
        'Scorpio' => '♏️ Scorpio',
        'Sagittarius' => '♐️ Sagittarius',
        'Capricorn' => '♑️ Capricorn',
        'Aquarius' => '♒️ Aquarius',
        'Pisces' => '♓️ Pisces'
    ];

    /** @var string */
    private $label;

    public function __construct(string $label)
    {
        $this->label = $label;
    }

    public function __toString(): string
    {
        if (!isset(self::TRANSLATION[$this->label])) {
            return $this->label;
        }

        return self::TRANSLATION[$this->label];
    }

    public function getOriginal()
    {
        return $this->label;
    }
}
