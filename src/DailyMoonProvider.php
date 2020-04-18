<?php

namespace DailyMoon;

use DailyMoon\API\Cache;
use DailyMoon\API\LunopiaClient;
use DailyMoon\Repositories\MoonPhaseRepository;
use DailyMoon\Wordpress\Bootstrap;
use DailyMoon\Wordpress\Widget;
use Phpfastcache\CacheManager;
use Phpfastcache\Config\ConfigurationOption;
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

        $container[Cache::class] = function () {
            CacheManager::setDefaultConfig(
                new ConfigurationOption([
                    'path' => plugin_dir_path( __FILE__ ) . "/../cache/api"
                ])
            );

            return new Cache(
                CacheManager::getInstance('files')
            );
        };

        $container[LunopiaClient::class] = function () use ($container) {
            return new LunopiaClient(
                getenv('LUNOPIA_API_BASE_URL'),
                getenv('LUNOPIA_API_KEY'),
                $container[Cache::class]
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
