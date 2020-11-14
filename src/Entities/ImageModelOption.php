<?php
declare(strict_types=1);

namespace DailyMoon\Entities;

class ImageModelOption
{
    /** @var array */
    public const AVAILABLE_IMAGE_MODEL = [1, 2, 3, 4, 5, 6];

    /** @var string */
    private $imageModel;

    public function __construct(int $imageModel)
    {
        $this->imageModel = $imageModel;
    }

    public function toInt(): int
    {
        return $this->imageModel;
    }
}
