<?php

declare(strict_types=1);

namespace App\Application\Actions;

use App\Application\Settings\SettingsInterface;
use App\Domain\DomainException\DomainRecordNotFoundException;
use DateTime;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Illuminate\Database\Capsule\Manager;
use Psr\Container\ContainerInterface;

abstract class Action
{
    protected LoggerInterface $logger;

    protected Request $request;

    protected Response $response;

    protected Manager $db;

    protected ContainerInterface $container;

    protected array $args;

    public function __construct(LoggerInterface $logger, ContainerInterface $container, Manager $db)
    {
        $this->logger = $logger;
        $this->db = $db;
        $this->container = $container;
    }

    /**
     * @throws HttpNotFoundException
     * @throws HttpBadRequestException
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        try {
            return $this->action();
        } catch (HttpNotFoundException $e) {
            throw new HttpNotFoundException($this->request, $e->getMessage());
        }
    }

    /**
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    abstract protected function action(): Response;

    /**
     * @return array|object
     */
    protected function getFormData()
    {
        return $this->request->getParsedBody();
    }

    /**
     * @return mixed
     * @throws HttpBadRequestException
     */
    protected function resolveArg(string $name)
    {
        if (!isset($this->args[$name])) {
            throw new HttpBadRequestException($this->request, "Could not resolve argument `{$name}`.");
        }

        return $this->args[$name];
    }

    /**
     * @param array|object|null $data
     */
    protected function respondWithData($data = null, int $statusCode = 200): Response
    {
        $payload = new ActionPayload($statusCode, $data);

        return $this->respond($payload);
    }

    protected function respond(ActionPayload $payload): Response
    {
        $json = json_encode($payload, JSON_PRETTY_PRINT);
        $this->response->getBody()->write($json);

        return $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($payload->getStatusCode());
    }

    protected function generateToken(array $payload): string
    {
        $settings = $this->container->get(SettingsInterface::class)->get('token');
        $serverParams = $this->request->getServerParams();
        return JWT::encode([
            'sub' => $payload,
            'iss' => $serverParams['HTTP_HOST'],
            'iat' => time(),
            'nbf' => (new DateTime())->modify("+{$settings['nbfIn']} minutes")->getTimestamp(),
            'exp' => (new DateTime())->modify("+{$settings['expiredIn']} minutes")->getTimestamp(),
        ], $settings['secretKey'], 'HS256');
    }

    protected function isDebugUser(int $userId)
    {
        return  $this->container->get(SettingsInterface::class)->get('debugUser') == $userId;
    }

    protected function isTimeGreaterThan(string $date1, int $seconds)
    {
        $datetime1 = new DateTime($date1);
        $now = new DateTime("now");
        $datetime1->modify("+$seconds seconds");
        return $now > $datetime1;
    }

    protected function isOverDurationFromTime(string $date1, int $seconds): bool
    {
        $datetime1 = new DateTime($date1);
        $now = new DateTime("now");
        $datetime1->modify("+$seconds seconds");
        return $now > $datetime1;
    }
}
