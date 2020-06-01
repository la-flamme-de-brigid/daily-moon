<?php
declare(strict_types=1);

namespace Tests\Support;

use Doctrine\DBAL\DriverManager;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $container)
    {
        $container[DatabaseConnection::class] = function () {

            $connectionParams = [
                'dbname' => getenv('DB_NAME'),
                'user' => getenv('DB_USER'),
                'password' => getenv('DB_PASSWORD'),
                'host' => 'localhost',
                'driver' => 'pdo_mysql'
            ];

             return new DatabaseConnection(
                 DriverManager::getConnection($connectionParams)
             );
        };
    }
}
