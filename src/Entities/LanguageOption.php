<?php
declare(strict_types=1);

namespace DailyMoon\Entities;

class LanguageOption
{
    /** @var string */
    private $language;

    public const EN = 'en_EN';
    public const FR = 'fr_FR';

    public function __construct(string $language)
    {
        $this->language = $language;
    }

    public function __toString()
    {
        return $this->language;
    }
}
