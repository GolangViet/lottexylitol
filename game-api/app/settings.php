<?php

declare(strict_types=1);

use App\Application\Settings\Settings;
use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {

    // Global Settings Object
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {
            return new Settings([
                'displayErrorDetails' => $_ENV['APP_ENV'] === 'development' ? true : false, // Should be set to false in production
                'logError'            => true,
                'logErrorDetails'     => true,
                'logger' => [
                    'name' => 'slim-app',
                    'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                    'level' => Logger::CRITICAL,
                ],
                'db' => [
                    'driver' => 'mysql',
                    'host' => $_ENV['DB_HOST'],
                    'port' => $_ENV['DB_PORT'],
                    'database' => $_ENV['DB_NAME'],
                    'username' => $_ENV['DB_USERNAME'],
                    'password' => $_ENV['DB_PASSWORD'],
                    'charset'   => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix'    => 'g_',
                ],
                "token" => [
                    "secretKey" => $_ENV['JWT_SECRET_KEY'],
                    "expiredIn" => $_ENV['JWT_EXPIRED_IN'], //minutes
                    "nbfIn" => 0, //minutes
                ],
                "allowedOrigins" => $_ENV['ALLOWED_ORIGINS'],
                "userApiUrl" => $_ENV['WP_USER_API_URL'],
                "debugUser" => isset($_ENV['DEBUG_USER']) ? $_ENV['DEBUG_USER'] : 0,
                "apiAuth" => [
                    "username" => $_ENV['API_AUTH_USER'],
                    "password" => $_ENV['API_AUTH_PASSWD']
                ]
            ]);
        }
    ]);
};
