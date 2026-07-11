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
        // 1. Lấy URL từ .env
        $apiUrl = $this->container->get(SettingsInterface::class)->get('userApiUrl');

        // 2. Lấy domain hiện tại
        $domain = $_SERVER['HTTP_HOST'] ?? 'lottexylitol.com.vn';

        // --- BẮT ĐẦU FIX THEO CÁCH CỦA SURVEY ---
        $connectUrl = $apiUrl;
        
        // Nếu URL chứa domain -> Thay thế bằng IP Public
        if (strpos($connectUrl, $domain) !== false) {
            // Dùng IP Public 160.191.88.107 (Giống Survey đang chạy ok)
            $connectUrl = str_replace($domain, '160.191.88.107', $connectUrl);
            
            // Ép về HTTP thường để tránh lỗi SSL
            $connectUrl = str_replace('https://', 'http://', $connectUrl);
        }
        // --- KẾT THÚC FIX ---

        try {
            $client = new Client();
            $response = $client->get($connectUrl, [
                'headers' => [
                    'Token' => $token,
                    'Content-Type' => 'application/json',
                    // QUAN TRỌNG: Gửi kèm Host Header để server 160.191.88.107 biết vào web nào
                    'Host' => $domain 
                ],
                'verify' => false,
                'http_errors' => false 
            ]);

            // --- XỬ LÝ KẾT QUẢ ---
            $statusCode = $response->getStatusCode();
            $bodyContent = $response->getBody()->getContents();

            if ($statusCode !== 200 && $statusCode !== 201) {
                // Hiện lỗi chi tiết nếu có
                throw new \Exception("API Error $statusCode: " . strip_tags(substr($bodyContent, 0, 200)));
            }

            $bodyData = json_decode($bodyContent);
            
            if (isset($bodyData->error) && $bodyData->code == 401) {
                throw new HttpBadRequestException($this->request, $bodyData->error);
            }

            return $bodyData->data;

        } catch (\Exception $exception) {
            if ($exception instanceof HttpBadRequestException) {
                throw $exception;
            }
            throw new HttpInternalServerErrorException($this->request, $exception->getMessage());
        }
    }
}
