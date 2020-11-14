<?php
declare(strict_types=1);

namespace Tests\Integration\Repositories;

use DailyMoon\Entities\ImageModelOption;
use DailyMoon\Repositories\BackgroundColorOptionRepository;
use DailyMoon\Repositories\ImageModelOptionRepository;
use Tests\Integration\TestCase;

require __DIR__ . '/../../../../../../wp-load.php';

class ImageModelOptionRepositoryTest extends TestCase
{
    protected function setUp(): void
    {
        delete_option('daily-moon-image-model');
    }

    public function testTheImageModelCanBeFetched()
    {
        $imageModel = 2;

        $repository = new ImageModelOptionRepository();
        $repository->store(new ImageModelOption($imageModel));
        $imageModelOption = $repository->find();

        $this->assertSame($imageModel, $imageModelOption->toInt());
    }

    public function testTheImageModelCanBeFetchedEvenIfThereIsNot()
    {
        $repository = new ImageModelOptionRepository();
        $imageModelOption = $repository->find();

        $this->assertSame(5, $imageModelOption->toInt());
    }

    public function testTheImageModelCanBeInserted()
    {
        $imageModel = 3;

        $repository = new ImageModelOptionRepository();
        $repository->store(new ImageModelOption($imageModel));

        $this->assertSame($imageModel, $this->database->getImageModelOption());
    }

    public function testTheImageModelCanBeUpdated()
    {
        $storedImageModel1 = new ImageModelOption(2);
        $storedImageModel2 = new ImageModelOption(5);

        $repository = new ImageModelOptionRepository();
        $repository->store($storedImageModel1);
        $repository->store($storedImageModel2);

        $this->assertSame($storedImageModel2->toInt(), $this->database->getImageModelOption());
    }
}
