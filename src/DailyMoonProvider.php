<?php

namespace DailyMoon;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class DailyMoonProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container[Renderer::class] = function () {
            return new Renderer();
        };
    }
}
