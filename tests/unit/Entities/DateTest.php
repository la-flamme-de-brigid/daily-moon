<?php
declare(strict_types=1);

namespace unit\Entities;

use Carbon\Carbon;
use DailyMoon\Entities\Date;
use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    /**
     * @dataProvider translatedMonthProvider
     */
    public function testThatSomeMonthsAreTranslated($expectedDate, $expectedTranslation)
    {

        $date = new Date($expectedDate);

        $this->assertStringContainsString($expectedTranslation, $date->__toString());
    }

    /**
     * @dataProvider nonTranslatedMonthProvider
     */
    public function testThatSomeMonthsArentTranslated($expectedDate, $expectedTranslation)
    {

        $date = new Date($expectedDate);

        $this->assertStringContainsString($expectedTranslation, $date->__toString());
    }


    public function translatedMonthProvider()
    {
        return [
            [Carbon::createFromDate(2020, 5), 'May'],
            [Carbon::createFromDate(2020, 6), 'June'],
            [Carbon::createFromDate(2020, 7), 'July']
        ];
    }

    public function nonTranslatedMonthProvider()
    {
        return [
            [Carbon::createFromDate(2020, 1), 'Jan.'],
            [Carbon::createFromDate(2020, 3), 'Mar.'],
            [Carbon::createFromDate(2020, 9), 'Sep.']
        ];
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
    }
}
