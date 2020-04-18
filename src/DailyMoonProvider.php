<?php

namespace DailyMoon;

use DailyMoon\API\LunopiaClient;
use DailyMoon\Repositories\MoonPhaseRepository;
use DailyMoon\Wordpress\Bootstrap;
use DailyMoon\Wordpress\Widget;
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
                'debug' => true,
                'strict_variables' => true
            ]);

            return $twig;
        };

        $container[LunopiaClient::class] = function () {
            return new LunopiaClient(
                getenv('LUNOPIA_API_BASE_URL'),
                getenv('LUNOPIA_API_KEY')
            );
        };

        $container[MoonPhaseRepository::class] = function () use ($container) {
            return new MoonPhaseRepository(
                new Client([
                    'base_uri' => getenv('ASTROSEEK_API')
                ]),
                $container[LunopiaClient::class]
            );
        };

        $container[Renderer::class] = function () use ($container) {
            return new Renderer(
                $container[Environment::class],
                $container[MoonPhaseRepository::class]
            );
        };

        $container[Widget::class] = function () use ($container) {
            return new Widget(
                $container[Renderer::class]
            );
        };

        $container[Bootstrap::class] = function () use ($container) {
            return new Bootstrap($container[Widget::class]);
        };
    }
}
