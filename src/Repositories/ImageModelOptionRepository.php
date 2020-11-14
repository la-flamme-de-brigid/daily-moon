<?php
declare(strict_types=1);

namespace DailyMoon\Repositories;

use DailyMoon\Entities\ImageModelOption;
use Exception;

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

        return new ImageModelOption((int) $imageModel);
    }

    public function store(ImageModelOption $imageModelOption): void
    {
        if (!in_array($imageModelOption->toInt(),ImageModelOption::AVAILABLE_IMAGE_MODEL)) {
            throw new Exception('This value of image model doesn\'t exist.');
        }
        
        if (!get_option(self::DAILY_MOON_IMAGE_MODEL_OPTION)) {
            add_option(self::DAILY_MOON_IMAGE_MODEL_OPTION, $imageModelOption->toInt());
        } else {
            update_option(self::DAILY_MOON_IMAGE_MODEL_OPTION, $imageModelOption->toInt());
        }
    }
}
