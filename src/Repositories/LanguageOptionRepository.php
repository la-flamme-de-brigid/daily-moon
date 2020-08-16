<?php
declare(strict_types=1);

namespace DailyMoon\Repositories;

use DailyMoon\Entities\LanguageOption;

class LanguageOptionRepository
{
    private const DAILY_MOON_LANGUAGE = 'daily-moon-language';

    public function find()
    {
        $colorValue = get_option(self::DAILY_MOON_LANGUAGE);

        if (!$colorValue) {
            return new LanguageOption(LanguageOption::EN);
        }

        return new LanguageOption($colorValue);
    }

    public function store(LanguageOption $color)
    {
        if (!get_option(self::DAILY_MOON_LANGUAGE)) {
            add_option(self::DAILY_MOON_LANGUAGE, strval($color));
        } else {
            update_option(self::DAILY_MOON_LANGUAGE, strval($color));
        }
    }
}
