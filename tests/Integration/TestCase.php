<?php
declare(strict_types=1);

namespace Tests\Integration;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Tests\Support\TestContainer;

class TestCase extends BaseTestCase
{
    /** @var TestContainer */
    protected $container;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->container = TestContainer::getInstance();
    }
}
