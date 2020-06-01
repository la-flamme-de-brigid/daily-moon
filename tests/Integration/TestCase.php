<?php
declare(strict_types=1);

namespace Tests\Integration;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Tests\Support\DatabaseConnection;
use Tests\Support\TestContainer;

class TestCase extends BaseTestCase
{

    /** @var DatabaseConnection */
    protected $database;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        /** @var TestContainer $container */
        $container = TestContainer::getInstance();

        /** @var DatabaseConnection database */
        $this->database = $container[DatabaseConnection::class];
    }
}
