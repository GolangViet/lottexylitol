<?php

if(defined('APP_PATH') && class_exists('lotte_news') == false) :

    /**
     * Lotte News
     */
    class lotte_news
    {
        var $detect_url = false;

        function get_cache($cache_key = '', $value = null)
        {
            global $lotte_caches;

            if(empty($lotte_caches)) return $value;

            if(isset($lotte_caches[$cache_key])) {
                $value = $lotte_caches[$cache_key];
            }

            return $value;
        }

        function set_cache($cache_key = '', $value = null)
        {
            global $lotte_caches;

            if(empty($lotte_caches)) $lotte_caches = [];

            if($value != null) {
                $lotte_caches[$cache_key] = $value;
            }
        }

        function get_list($cat_slug = '', $paged = 1)
        {
            $cache_key = $cat_slug . '_' . $paged;

            $data = $this->get_cache($cache_key, []);

            if(count($data)>0) {
                return $data;
            }
            
            $file = APP_PATH . "uploads/news/{$cat_slug}/page-{$paged}.json";

            if(file_exists($file)) {
                $data = json_decode(file_get_contents($file), true);
            }

            $data = $this->map_data('list', $data);

            $this->set_cache($cache_key, $data);

            return $data;
        }

        function get_detail($name = '')
        {
            $cache_key = 'detail_' . $name;

            $data = $this->get_cache($cache_key, []);

            if (isset($data['title'])) {
                return $data;
            }

            $file = APP_PATH . "uploads/news/detail/{$name}.json";

            if(file_exists($file)) {
                $data = json_decode(file_get_contents($file), true);
            }

            $data = $this->map_data('detail', $data);

            $this->set_cache($cache_key, $data);

            return $data;
        }

        function map_data($type = '', $data = [])
        {
            $defaults = [];

            if ($type == 'summary' || $type == 'detail') {
                $defaults = array(
                    "title"     => "",
                    "name"      => "",
                    "status"    => "",
                    "thumbnail" => "",
                );

                if ($type == 'summary') {
                    $more = array(
                        "excerpt" => "",
                        "cat_name" => "",
                    );
                } else {
                    $more = array(
                        "content" => "",
                        "name_vi" => "",
                        "name_en" => "",
                    );
                }

                $more['date'] = '';

                $defaults = array_merge($defaults, $more);
            } else if ($type == 'list') {
                $defaults = array(
                    "items" => [],
                    "paged" => 1,
                    "total" => 0,
                    "max_num_pages" => 0,
                );
            }

            $data = $this->atts($defaults, $data);

            if(isset($data['date'])) {
                // $data['date'] = date('d / m / Y', $data['date']);

                $data['date'] = date_format(date_create($data['date']), 'd / m / Y');
            }

            return $data;
        }

        function get_pagi_html($params = [])
        {
            extract($this->atts(array(
                'active' => 1,
                'total' => 0,
                'limit' => 9,
                'link' => '#',
                'number_pages' => 5, // 10 page - set max: 9;
                'show_arrow' => 'hide', // 1: show, 2: always
            ), $params));

            if ($total == 0 || $limit == 0) {
                return '';
            }

            $end = intval($total / $limit);
            if ($total % $limit > 0) {
                $end++;
            }

            if ($end < 2) {
                return '';
            }

            $start = $active - intval($number_pages / 2);
            if ($start + $number_pages > $end) {
                $start = $end - $number_pages + 1;
            }
            if ($start < 1) {
                $start = 1;
            }
            $prev    = $active - 1;
            if ($prev < 1) {
                $prev = 1;
            }
            $next    = $active + 1;
            if ($next > $end) {
                $next = $end;
            }
            $stop     = $start + $number_pages - 1;
            if ($stop > $end) {
                $stop = $end;
            }

            $html = '';

            $html .= '<nav class="pagination" aria-label="Page navigation">';

            if ($show_arrow == 'always' || ($show_arrow == 'show' && $active > 1)) {
                $html .= '<a href="' . $this->get_pagi_link($link, $prev > 1 ? ['paged' => $prev] : []) . '" aria-label="Start" class="arrow hover arrow-prev"><img src="' . APP_ASSETS . 'img/news/arrow-prev.png" alt=""></a>';
            }

            $html .= '<ul class="number">';

            for ($page = $start; $page <= $stop; $page++) {
                $html .= '<li class="item' . ($page == $active ? ' active' : '') . '"><a class="link" href="' . $this->get_pagi_link($link, $page > 1 ? ['paged' => $page] : []) . '"><span>' . $page . '</span></a></li>';
            }

            $html .= '</ul>';

            if ($show_arrow == 'always' || ($show_arrow == 'show' && $end > $active)) {
                $html .= '<a href="' . $this->get_pagi_link($link, $next > 1 ? ['paged' => $next] : []) . '" aria-label="End" class="arrow hover arrow-next"><img src="' . APP_ASSETS . 'img/news/arrow-next.png" alt=""></a>';
            }

            $html .= '</nav>';

            return $html;
        }

        function get_pagi_link($link = '', $params = [])
        {
            if($this->detect_url == true && isset($params['paged'])) {
                $link .= 'page-' . $params['paged'];

                unset($params['paged']);
            }

            if (count($params) > 0) {
                $link .= '?' . http_build_query($params, '', '&');
            }

            return $link;
        }

        function atts($atts = [], $inputs = [])
        {
            foreach ($atts as $key => $value) {
                if (isset($inputs[$key])) {
                    $value = $inputs[$key];
                }

                $atts[$key] = $value;
            }

            return $atts;
        }

        function get_date($time) {
            return date('d / m / Y', $time);
        }

        function get_path_name($sub_folder = '')
        {
            $uri = explode('?', $_SERVER['REQUEST_URI']);

            $uri = $uri[0];

            if($sub_folder != '') {
                $uri = rtrim(str_replace($sub_folder, '', $uri), '/');
            }

            return $uri;
        }

        function detect_url($sub_folder = '')
        {
            $this->set_detect_url(true);

            $path_name = $this->get_path_name($sub_folder);
            if($path_name != '') {
                if(substr($path_name, 0, 5) == 'page-') {
                    $_GET['paged'] = (int) str_replace('page-', '', $path_name);
                } else {
                    $_GET['p'] = $path_name;
                }
            }
        }

        function set_detect_url($value = false)
        {
            $this->detect_url = $value;
        }
    }

    $lotte_news = new lotte_news();

endif;