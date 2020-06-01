<?php
declare(strict_types=1);

namespace Tests\Support;

use Pimple\Container;

class TestContainer
{
    /** @var Container */
    private static $instance;

    public static function getInstance(): Container
    {
        if (is_null(self::$instance)) {
            self::$instance = self::instantiateContainer();
        }

        return self::$instance;
    }

    private static function instantiateContainer(): Container
    {
        $c = new Container;

        $c->register(new ServiceProvider);

        return $c;
    }
}
