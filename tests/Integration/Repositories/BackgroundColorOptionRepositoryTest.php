<?php
declare(strict_types=1);

namespace Tests\Integration\Repositories;

use DailyMoon\Repositories\BackgroundColorOptionRepository;
use Tests\Integration\TestCase;

class BackgroundColorOptionRepositoryTest extends TestCase
{
    public function testTheBackgroundColorCanBeFetched()
    {
        $storedColor = '#000';

        $repository = new BackgroundColorOptionRepository();
        $repository->store($storedColor);
        $backgroundColor = $repository->find();

        $this->assertSame($storedColor, $backgroundColor->__toString());
    }

    public function testTheBackgroundColorCanBeFetchedEvenIfThereIsNot()
    {
        $repository = new BackgroundColorOptionRepository();
        $backgroundColorValue = $repository->find();

        $this->assertSame('#fff', $backgroundColorValue->__toString());
    }

    public function testTheBackgroundColorCanBeInserted()
    {
        $storedColor = '#000';

        $repository = new BackgroundColorOptionRepository();
        $repository->store($storedColor);

        $this->assertSame($storedColor, $this->database->getBackgroundColor());
    }

    public function testTheBackgroundColorCanBeUpdated()
    {
        $storedColor1 = '#000';
        $storedColor2 = '#fff';

        $repository = new BackgroundColorOptionRepository();
        $repository->store($storedColor1);
        $repository->store($storedColor2);

        $this->assertSame($storedColor2, $this->database->getBackgroundColor());
    }
}
