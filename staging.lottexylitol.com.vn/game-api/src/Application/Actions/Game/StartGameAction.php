<?php

declare(strict_types=1);

namespace App\Application\Actions\Game;

use App\Application\Actions\Action;
use App\Application\Settings\SettingsInterface;
use DateTime;
use Psr\Http\Message\ResponseInterface as Response;
use GuzzleHttp\Client;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Exception\HttpNotFoundException;

class StartGameAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $gameId = $this->resolveArg('id');
        $game = $this->db->table('games')->where('id', $gameId)->first();
        if (is_null($game)) {
            throw new HttpNotFoundException($this->request, "GAME_NOT_FOUND");
        }

        $postData = $this->getFormData();
        $wpUser = $this->fetchUserInfo($postData['token']);
        $user = $this->db->table('users')->where('wp_user_id', $wpUser->user_id)->first();
        if (is_null($user)) {
            $userId = $this->db->table('users')->insertGetId([
                'wp_user_id' => $wpUser->user_id,
                'username' => $wpUser->name,
                'status' => 1
            ]);
        } else {
            $userId = $user->id;
        }

        $latestSession = $this->db->table('game_sessions')->where([
            ['user_id', '=', $userId],
            ['game_id', '=', $gameId],
            ['is_finished', '=', 0],
        ])->orderByDesc('start_time')->first();
        // check the last unfinished session must over 2 minutes before starting a new game
        if (!is_null($latestSession) && !$this->isOverDurationFromTime($latestSession->start_time, 120)) {
            throw new HttpBadRequestException($this->request, 'GAME_ALREADY_STARTED');
        }

        // create new game play
        $gamePlayId = $this->db->table('game_sessions')->insertGetId([
            'user_id' => $userId,
            'game_id' => $gameId,
            'start_time' => new DateTime("now"),
        ]);

        // issue the access token and the game token
        return $this->respondWithData([
            "user_id" => $userId,
            "full_name" => $wpUser->name,
            "token" => $this->generateToken([
                "session_id" => $gamePlayId,
                "user_id" => $userId,
                "game_id" => $gameId,
            ]),
        ]);
    }

    protected function fetchUserInfo(string $token)
    {
        $apiUrl = $this->container->get(SettingsInterface::class)->get('userApiUrl');
        try {
            $client = new Client();
            $response = $client->get($apiUrl, ['headers' => [
                'Token' => $token,
                'Content-Type' => 'application/json'
            ]]);

            if ($response->getStatusCode() !== 200 && $response->getStatusCode() !== 201) {
                throw new HttpBadRequestException($this->request, "UNABLE_GET_USER");
            }

            $bodyData = json_decode($response->getBody()->getContents());
            if (isset($bodyData->error) && $bodyData->code == 401) {
                throw new HttpBadRequestException($this->request, $bodyData->error);
            }

            return $bodyData->data;
        } catch (\Exception $exception) {
            if ($exception instanceof HttpBadRequestException) {
                throw $exception;
            }

            throw new HttpInternalServerErrorException($this->request, "UNABLE_GET_USER");
        }
    }
}
