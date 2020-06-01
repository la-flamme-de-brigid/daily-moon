<?php
declare(strict_types=1);

namespace Tests\Integration\Repositories;

use DailyMoon\Repositories\BackgroundColorOptionRepository;
use Tests\Integration\TestCase;

class BackgroundColorOptionRepositoryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->database->deleteBgColorOption();
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
