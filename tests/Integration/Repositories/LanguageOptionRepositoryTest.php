<?php
declare(strict_types=1);

namespace Tests\Integration\Repositories;

use DailyMoon\Entities\LanguageOption;
use DailyMoon\Repositories\LanguageOptionRepository;
use Tests\Integration\TestCase;

require __DIR__ . '/../../../../../../wp-load.php';

class LanguageOptionRepositoryTest extends TestCase
{
    protected function setUp(): void
    {
        delete_option('daily-moon-language');
    }

    public function testTheLanguageCanBeFetched()
    {
        $storedLanguage = new LanguageOption(LanguageOption::FR);

        $repository = new LanguageOptionRepository();
        $repository->store($storedLanguage);
        $backgroundColor = $repository->find();

        $this->assertSame(strval($storedLanguage), $backgroundColor->__toString());
    }

    public function testTheLanguageCanBeFetchedEvenIfThereIsNot()
    {
        $repository = new LanguageOptionRepository();
        $backgroundColorValue = $repository->find();

        $this->assertSame(LanguageOption::EN, $backgroundColorValue->__toString());
    }

    public function testTheLanguageCanBeInserted()
    {
        $storedLanguage = new LanguageOption(LanguageOption::FR);

        $repository = new LanguageOptionRepository();
        $repository->store($storedLanguage);

        $this->assertSame(strval($storedLanguage), $this->database->getLanguage());
    }

    public function testTheLanguageCanBeUpdated()
    {
        $storedLanguage1 = LanguageOption::FR;
        $storedLanguage2 = LanguageOption::EN;

        $repository = new LanguageOptionRepository();
        $repository->store(new LanguageOption($storedLanguage1));
        $repository->store(new LanguageOption($storedLanguage2));

        $this->assertSame($storedLanguage2, $this->database->getLanguage());
    }
}
