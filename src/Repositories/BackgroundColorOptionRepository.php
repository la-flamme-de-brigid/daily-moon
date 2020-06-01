<?php
declare(strict_types=1);

namespace DailyMoon\Repositories;

require __DIR__ . '/../../../../../wp-load.php';

class BackgroundColorOptionRepository
{
    private const DAILY_MOON_BACKGROUND_COLOR = 'daily-moon-background-color';

    public function store(string $color)
    {
        if (!get_option(self::DAILY_MOON_BACKGROUND_COLOR)) {
            add_option(self::DAILY_MOON_BACKGROUND_COLOR, $color);
        } else {
            update_option(self::DAILY_MOON_BACKGROUND_COLOR, $color);
        }
    }
}
