<?php

declare(strict_types=1);

namespace App\Application\Middleware;

use App\Application\Settings\SettingsInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\MiddlewareInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Exception\HttpUnauthorizedException;

class AuthMiddleware implements MiddlewareInterface
{
    private ContainerInterface $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(Request $request, RequestHandler $handler): Response
    {
        $jwtToken = $request->getHeaderLine('x-auth-token');
        if (empty($jwtToken)) {
            throw new HttpUnauthorizedException($request, "Unauthorized.");
        }

        $settings = $this->container->get(SettingsInterface::class);
        try {
            $payload = JWT::decode($jwtToken, new Key($settings->get('token')['secretKey'], 'HS256'));
            $request = $request->withAttribute('currentUser', $payload->sub->user_id);
            $request = $request->withAttribute('tokenData', $payload->sub);
        } catch (\Throwable $th) {
            throw new HttpInternalServerErrorException($request, "INVALID_TOKEN");
        }
        return $handler->handle($request);
    }
}
