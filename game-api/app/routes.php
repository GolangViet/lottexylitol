<?php

declare(strict_types=1);

use App\Application\Actions\Game\EndGameAction;
use App\Application\Actions\Manage\GameScoresAction;
use App\Application\Actions\Game\StartGameAction;
use App\Application\Middleware\BasicAuthMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    $app->setBasePath(ROUTE_BASE_PATH);

    $app->options("/{routes:.*}", function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write(json_encode(["message" => "Hello World"]));
        return $response;
    });

    $app->get('/mock/user', function (Request $request, Response $response) {
        $response->getBody()->write(json_encode(["data" => [
            "user_id" => 0,
            "name" => "Player 01",
        ]]));
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    });

    $app->post('/game/{id}/start', StartGameAction::class);
    $app->post('/game/{id}/end', EndGameAction::class);
    $app->get('/manage/game-scores', GameScoresAction::class)->add(BasicAuthMiddleware::class);
};
