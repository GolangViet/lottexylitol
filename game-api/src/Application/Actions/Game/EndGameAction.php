<?php

declare(strict_types=1);

namespace App\Application\Actions\Game;

use App\Application\Actions\Action;
use App\Application\Settings\SettingsInterface;
use DateTime;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Exception\HttpNotFoundException;

class EndGameAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $gameId = $this->resolveArg('id');
        $game = $this->db->table('games')->where('id', $gameId)->first();

        $postData = $this->getFormData();
        $tokenData = $this->parseTokenData($postData['token']);
        if (is_null($game) || $tokenData->game_id !== $gameId) {
            throw new HttpNotFoundException($this->request, "GAME_NOT_FOUND");
        }

        $session = $this->db->table('game_sessions')->where([
            ['id', '=', $tokenData->session_id],
            ['user_id', '=', $tokenData->user_id],
            ['game_id', '=', $tokenData->game_id]
        ])->first();

        if (
            is_null($session) // if the session does not exist or not belong to the user
            || $session->is_finished === 1 // if the session has finished
            || $this->isTimeGreaterThan($session->start_time, 125) // if the time is greater than the limited time (120 + additional 5 seconds)
            || (int)$postData['score'] > 120 // if the score is greater than the maximum of score 120 (1 shot per second)
            || !$this->isValidData($postData['metadata'], (int)$postData['score']) // if the metadata is invalid
        ) {
            throw new HttpBadRequestException($this->request, "INVALID_DATA");
        }

        try {
            $this->db->table('game_sessions')
                ->where('id', $session->id)
                ->update([
                    'is_finished' => 1,
                    'score' => (int) $postData['score'],
                    'end_time' => new DateTime(),
                    'played_time' => (int) $postData['played']
                ]);

            return $this->respondWithData(true);
        } catch (\Throwable $th) {
            throw new HttpInternalServerErrorException($this->request);
        }
    }

    /**
     * Check the game data is valid or not
     */
    private function isValidData(string $metadata, int $score): bool
    {
        $data = json_decode($metadata, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return false;
        }

        // check the score and the number of shots are matched
        if (count($data) !== $score) return false;

        $startTime = 0;
        foreach ($data as $key => $value) {
            list($id, $time) = explode(':', $value);
            $startTime = $startTime === 0 ? (int)$time : $startTime;
            // check the time of each shot is valid or not
            if ((int)$time < $startTime + ($key * 900)) {
                return false;
            }
        }
        return true;
    }

    private function parseTokenData(string $token)
    {
        if (empty($token)) {
            throw new HttpInternalServerErrorException($this->request, "INVALID_TOKEN");
        }

        $settings = $this->container->get(SettingsInterface::class);
        try {
            $payload = JWT::decode($token, new Key($settings->get('token')['secretKey'], 'HS256'));
            return $payload->sub;
        } catch (\Throwable $th) {
            throw new HttpInternalServerErrorException($this->request, "INVALID_TOKEN");
        }
    }
}
