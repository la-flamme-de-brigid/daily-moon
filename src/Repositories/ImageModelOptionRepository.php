<?php
declare(strict_types=1);

namespace DailyMoon\Repositories;

use DailyMoon\Entities\ImageModelOption;

require __DIR__ . '/../../../../../wp-load.php';

class ImageModelOptionRepository
{
    private const DAILY_MOON_IMAGE_MODEL_OPTION = 'daily-moon-image-model';

    public function find(): ImageModelOption
    {
        $imageModel = get_option(self::DAILY_MOON_IMAGE_MODEL_OPTION);

        if (!$imageModel) {
            return new ImageModelOption(5);
        }

        return new ImageModelOption($imageModel);
    }

    public function store(ImageModelOption $imageModelOption): void
    {
        if (!get_option(self::DAILY_MOON_IMAGE_MODEL_OPTION)) {
            add_option(self::DAILY_MOON_IMAGE_MODEL_OPTION, $imageModelOption->toInt());
        } else {
            update_option(self::DAILY_MOON_IMAGE_MODEL_OPTION, $imageModelOption->toInt());
        }
    }
}
