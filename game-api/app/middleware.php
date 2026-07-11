<?php

declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use Slim\App;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

return function (App $app) {
    $app->add(function (Request $request, RequestHandler $handler) use ($app) {
        $config = $app->getContainer()->get(SettingsInterface::class);
        return $handler->handle($request)->withHeader('Access-Control-Allow-Origin', $config->get('allowedOrigins'))
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization, x-auth-token')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });
};
