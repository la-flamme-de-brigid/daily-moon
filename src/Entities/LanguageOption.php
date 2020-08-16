<?php
declare(strict_types=1);

namespace DailyMoon\Entities;

class LanguageOption
{
    /** @var string */
    private $language;

    public const EN = 'EN';
    public const FR = 'FR';

    public function __construct(string $language)
    {
        $this->language = $language;
    }

    public function __toString()
    {
        return $this->language;
    }
}
