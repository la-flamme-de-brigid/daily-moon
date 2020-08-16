<?php
declare(strict_types=1);

namespace DailyMoon\Repositories;

use DailyMoon\Entities\BackgroundColorOption;

require __DIR__ . '/../../../../../wp-load.php';

class BackgroundColorOptionRepository
{
    private const DAILY_MOON_BACKGROUND_COLOR = 'daily-moon-background-color';

    public function find()
    {
        $colorValue = get_option(self::DAILY_MOON_BACKGROUND_COLOR);

        if (!$colorValue) {
            return new BackgroundColorOption('#fff');
        }

        return new BackgroundColorOption($colorValue);
    }

    public function store(BackgroundColorOption $color)
    {
        if (!get_option(self::DAILY_MOON_BACKGROUND_COLOR)) {
            add_option(self::DAILY_MOON_BACKGROUND_COLOR, strval($color));
        } else {
            update_option(self::DAILY_MOON_BACKGROUND_COLOR, strval($color));
        }
    }
}
