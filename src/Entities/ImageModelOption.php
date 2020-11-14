<?php
declare(strict_types=1);

namespace DailyMoon\Entities;

class ImageModelOption
{
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
