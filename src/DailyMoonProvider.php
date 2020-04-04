<?php

namespace DailyMoon;

use Pimple\Container;
use Twig\Environment;
use Pimple\ServiceProviderInterface;

class DailyMoonProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container[Environment::class] = function () {            
            $loader = new \Twig\Loader\FilesystemLoader(plugin_dir_path( __FILE__ ) . "/../templates");
            $twig = new \Twig\Environment($loader, [
                'cache' => plugin_dir_path( __FILE__ ) . '/cache',
            ]);

            return $twig;
        };

        $container[Renderer::class] = function () use ($container) {
            return new Renderer(
                $container[Environment::class]
            );
        };
    }
}
