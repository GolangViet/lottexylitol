<?php

declare(strict_types=1);

namespace App\Application\Middleware;

use App\Application\Settings\SettingsInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\MiddlewareInterface;
use Slim\Exception\HttpUnauthorizedException;

class BasicAuthMiddleware implements MiddlewareInterface
{
    private ContainerInterface $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(Request $request, RequestHandler $handler): Response
    {
        $authToken = $request->getHeaderLine('x-auth-token');
        if (!$authToken) {
            throw new HttpUnauthorizedException($request, "Unauthorized.");
        }

        $settings = $this->container->get(SettingsInterface::class);
        $authData = explode(":", base64_decode($authToken));
        if (
            count($authData) < 2 ||
            $settings->get('apiAuth')['username'] !== $authData[0]
            || $settings->get('apiAuth')['password'] !== $authData[1]
        ) {
            throw new HttpUnauthorizedException($request, "Unauthorized.");
        }

        return $handler->handle($request);
    }
}
