<?php
defined('ABSPATH') or die();

function site_api_winner_get_items()
{
    $items = site_winner_get_terms();

    if ($items) {
        foreach ($items as $i => $item) {
            $list = [];

            if(count($item['childs']) > 0) {
                foreach ($item['childs'] as $child) {
                    $ym = substr($child['slug'], 0, 7);

                    if (empty($list[$ym])) $list[$ym] = [];

                    $list[$ym]['question'] = $child['description'];
                    $list[$ym]['winners'] = site_winner_get_posts([
                        'category' => $child['slug']
                    ]);
                }
            } else {
                $list_posts = site_winner_get_posts([
                    'category' => $item['slug']
                ]);

                foreach ($list_posts as $data) {
                    $ym = date('Y-m', strtotime($data['date']));

                    if (empty($list[$ym])) {
                        $list[$ym] = [
                            'winners' => []
                        ];
                    }
        
                    $list[$ym]['winners'][] = $data;
                }
            }

            $item['list'] = $list;

            unset($item['childs']);

            $items[$i] = $item;
        }
    }
    
    $response = [
        'code' => 200,
        'items' => $items,
        'message' => 'Request success'
    ];

    return $response;
}

/*
function site_api_winner_page_get_items()
{
    $lang = site_api_get_lang();

    if($lang == 'en') {
        $winner_id = get_option('winner_id_en', 0);
    } else {
        $winner_id = get_option('winner_id', 0);
    }

    $items = site_winner_get_data_by($winner_id);

    $response = [
        'code' => 200,
        'items' => $items,
        'message' => 'Request success'
    ];

    return $response;
}
*/