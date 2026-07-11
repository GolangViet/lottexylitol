<?php

declare(strict_types=1);

namespace App\Application\Actions\Manage;

use App\Application\Actions\Action;
use DateTime;
use Psr\Http\Message\ResponseInterface as Response;

class GameScoresAction extends Action
{
    private $orderFields = ['start_time', 'end_time', 'score'];

    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $params = $this->request->getQueryParams();
        $where = ["is_finished" => 1];
        if (isset($params['game_id'])) $where['game_id'] = $params['game_id'];
        if (isset($params['user_id'])) $where['users.wp_user_id'] = (int) $params['user_id'];

        $query = $this->db->table('game_sessions')
            ->leftJoin('users', 'users.id', '=', 'game_sessions.user_id')
            ->where($where)
            ->select('users.username', 'users.wp_user_id', 'game_sessions.*');

        if (isset($params['limit'])) $query->limit((int) $params['limit']);
        if (isset($params['offset'])) $query->offset((int) $params['offset']);
        if (isset($params['order'])) {
            list($field, $direction) = explode(".", $params['order']);
            if (in_array($field, $this->orderFields) && in_array(strtolower($direction), ['asc', 'desc'])) {
                $query->orderBy($field, $direction);
            }
        }

        $result = array_map(function ($data) {
            return [
                'user_id' => $data->wp_user_id,
                'user_name' => $data->username,
                'game_id' => $data->game_id,
                'start_time' => $data->start_time,
                'end_time' => $data->end_time,
                'score' => $data->score
            ];
        }, $query->get()->toArray());

        return $this->respondWithData($result);
    }
}
