<?php

namespace DailyMoon;

use Pimple\Container;
use Twig\Environment;
use GuzzleHttp\Client;
use Pimple\ServiceProviderInterface;

class DailyMoonProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container[Environment::class] = function () {            
            $loader = new \Twig\Loader\FilesystemLoader(plugin_dir_path( __FILE__ ) . "/../templates");
            $twig = new \Twig\Environment($loader, [
                'cache' => false,
            ]);

            return $twig;
        };

        $container[MoonPhaseRepository::class] = function () use ($container) {
            return new MoonPhaseRepository(
                new Client([
                    'base_uri' => getenv('ASTROSEEK_API')
                ]),
                new Client([
                    'base_uri' => getenv('LUNOPIA_API_BASE_URL'),
                    'query' => [
                        'key' => getenv('LUNOPIA_API_KEY')
                    ]
                ]),
                new CrawlerFactory()
            );
        };

        $container[Renderer::class] = function () use ($container) {
            return new Renderer(
                $container[Environment::class],
                $container[MoonPhaseRepository::class]
            );
        };
    }
}
