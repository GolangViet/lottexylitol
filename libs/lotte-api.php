<?php

if (defined('APP_PATH') && class_exists('lotte_api') == false) :

    /**
     * Lotte API
     */
    class lotte_api
    {
        var $gmt_offset = 7;

        function curl_send($url = '', $post_data = array(), $headers = array())
        {
            if (filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED) == false) return false;

            $ch = curl_init();

            // $domain = 'lottexylitol.com.vn';
            $domain = $_SERVER['HTTP_HOST'];

            // --- ĐOẠN CODE FIX V2 (CẬP NHẬT) ---
            if (strpos($url, $domain) !== false) {
                // 1. Trỏ thẳng IP
                $url = str_replace($domain, '160.191.88.107', $url);

                // 2. Ép dùng HTTP
                $url = str_replace('https://', 'http://', $url);

                // 3. QUAN TRỌNG: Sửa lại Header Host chuẩn xác hơn
                if (!is_array($headers)) $headers = [];

                // Xóa header Host cũ nếu có để tránh trùng
                $headers = array_filter($headers, function($h) {
                    return stripos($h, 'Host:') === false;
                });

                // Thêm Header Host mới (Lưu ý không có http://, chỉ có domain)
                $headers[] = "Host: $domain";
            }
            // --- HẾT ---

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_AUTOREFERER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);

            // customize follow server
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

            if (count($headers) > 0) {
                curl_setopt($ch, CURLOPT_HEADER, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            }

            if (is_string($post_data)) {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            } else if (count($post_data) > 0) {
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data, '', '&'));
            }

            $response = curl_exec($ch);

            // Then, after your curl_exec call:
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            // $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);

            // Deprecated: Function curl_close() is deprecated
            // curl_close($ch);
            $ch = null;

            return $body;
        }

        function api_call($route = '', $post_data = array(), $headers = array())
        {
            // $api_file = APP_PATH . 'api/index.php';

            // if(file_exists($api_file)) {
            //     @ob_start();

            //     // Set temp
            //     $post = $_POST;
            //     $method = $_SERVER['REQUEST_METHOD'];
            //     $server_names = [];

            //     if(count($post_data)>0) {
            //         $_POST = $post_data;
            //         $_SERVER['REQUEST_METHOD'] = 'POST';
            //     }

            //     // $_SERVER['REQUEST_API_URI'] = $route;
            //     $_SERVER['REQUEST_URI'] = $route;

            //     if(count($headers)>0) {
            //         foreach($headers as $item) {
            //             $item = array_map('trim', explode(':', $item));

            //             $name = 'HTTP_' . strtoupper($item[0]);

            //             if(empty($_SERVER[$name])) {
            //                 $_SERVER[$name] = $item[1];
            //                 $server_names[] = $name;
            //             }
            //         }
            //     }

            //     require $api_file;

            //     $content = ob_get_clean();

            //     // Reset
            //     $_POST = $post;
            //     $_SERVER['REQUEST_METHOD'] = $method;
            //     unset($_SERVER['REQUEST_URI']);
            //     if(count($server_names)>0) {
            //         foreach($server_names as $name) {
            //             unset($_SERVER[$name]);
            //         }
            //     }

            //     return $content;
            // }

            $url = $this->get_domain() . '/api';

            // localhost
            if (file_exists(APP_PATH . 'api/index.php') == false) {
                return '{"code":401, "messages":"Localhost can not run"}';
            }

            return $this->curl_send($url . $route, $post_data, $headers);
        }

        function api_request($route = '', $data = array())
        {
            $headers = [
                'Accept: application/json'
            ];

            /**
             * htaccess
             * ----
             *  RewriteEngine on
             *  RewriteCond %{HTTP:Authorization} ^(.*)
             *  RewriteRule ^(.*) - [E=HTTP_AUTHORIZATION:%1]
             *
             */
            $authorization = $this->get_header('authorization');
            if ($authorization != '') {
                $headers[] = 'Authorization: ' . $authorization;
            }

            $token = $this->get_token();
            if ($token != '') {
                $headers[] = 'Token: ' . $token;
            }

            // call folder api
            $response = $this->api_call($route, $data, $headers);

            if ($response != '') {
                return json_decode($response, true);
            }

            return false;
        }

        function get_domain()
        {
            return 'http' . (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" ? 's' : '') . "://" . $_SERVER["HTTP_HOST"];
        }

        function get_header($name = '')
        {
            $headers = [];

            foreach (getallheaders() as $key => $value) {
                $headers[strtolower($key)] = $value;
            }

            if (empty($headers['authorization']) && !empty($_SERVER["REDIRECT_HTTP_AUTHORIZATION"])) {
                $headers['authorization'] = $_SERVER["REDIRECT_HTTP_AUTHORIZATION"];
            }

            $name = strtolower(trim($name));
            if ($name != '') {
                if (isset($headers[$name])) {
                    return $headers[$name];
                }

                return '';
            }

            return $headers;
        }

        private function base64_url_decode($text)
        {
            return trim(base64_decode(str_pad(strtr($text, '-_', '+/'), strlen($text) % 4, '=', STR_PAD_RIGHT)));
        }

        function get_token()
        {
            if (isset($_COOKIE['lot_token'])) {
                return $_COOKIE['lot_token'];
            }

            return '';
        }

        private function set_token($value = '')
        {
            @setcookie('lot_token', $value, strtotime('+20 minutes'), '/'); // Old expire: strtotime('+6 months')
        }

        function is_lang($lang = 'vi')
        {
            return strpos($_SERVER['REQUEST_URI'], '/' . $lang . '/') > -1;
        }

        /**
         * User
         */
        function get_current_user()
        {
            if($this->is_logged_in() == false) {
                return false;
            }

            global $lotte_user, $lotte_token_data;

            if (isset($lotte_user)) {
                return $lotte_user;
            }

            $route = '/user/info';

            if ($this->is_lang('en')) {
                $route .= '?lang=en';
            }

            $response = $this->api_request($route);

            if (isset($response['code']) && $response['code'] == 200 && isset($response['user'])) {
                $lotte_user = $response['user'];

                // if(isset($lotte_user['name']) && isset($lotte_token_data['exp'])) {
                //     $info = $lotte_user['name'];

                //     $info = base64_encode($info);

                //     @setcookie('lot_info', $info, $lotte_token_data['exp'], '/');
                // }
            } else {
                $this->set_token('');

                return false;
            }

            return $lotte_user;
        }

        function get_user_field($name = '', $default = '')
        {
            $user = $this->get_current_user();

            if($name == '' || $user == false || is_array($user) == false) return $default;

            if(isset($user[$name])) {
                return $user[$name];
            }

            return $default;
        }

        function is_logged_in()
        {
            global $lotte_token_data;

            $token = $this->get_token();

            $params = explode('.', $token);

            if ($token == '' || count($params) != 3) {
                return false;
            }

            $data = $this->base64_url_decode($params[1]);

            if(strpos($data, '{') > -1 || strpos($data, '}') > -1) {
                $data = json_decode($data, true);
            }

            if(empty($data['exp']) || intval($data['exp']) < $this->get_time()) {
                return false;
            }

            $lotte_token_data = $data;

            return true;
        }

        function logout()
        {
            return $this->set_token('');
        }

        /**
         * Survey
         */
        function get_surveys($subname = '')
        {
            global $lotte_surveys;

            if (isset($lotte_surveys)) {
                return $lotte_surveys;
            }

            $route = '/user/survey';

            if ($subname != '') {
                $route .= $subname;
            }

            if ($this->is_lang('en')) {
                $route .= '?lang=en';
            }

            $response = $this->api_request($route);

            if (isset($response['code']) && $response['code'] == 200 && isset($response['items'])) {
                $lotte_surveys = $response['items'];
            } else {
                return false;
            }

            return $lotte_surveys;
        }

        function get_time()
        {
            return time() + $this->gmt_offset * 60 * 60;
        }

        function check_survey_expired($subname = '')
        {
            $key = 'survey_expires';

            if ($subname == 'brand') {
                $key = 'survey_brand_expires';
            }

            $this->check_expired($key);
        }

        function check_contest_expired()
        {
            $this->check_expired('contest_expires');
        }

        function check_game_expired()
        {
            $this->check_expired('game_expires');
        }

        function check_expired($key = '', $redirect_to = '')
        {
            $user = $this->get_current_user();

            if ($redirect_to == '') {
                $redirect_to = ($this->is_lang('en') ? '/en/' : '') . '/activity-page';
            }

            if ($user == false) {
                header("Location: $redirect_to");
                exit();
            }

            if (isset($user[$key]) && $user[$key] > $this->get_time()) {
                header("Location: {$redirect_to}?msg=expired");
                exit();
            }

            $key_link = str_replace('_expires', '_link', $key);
            $info = $this->get_activity_info();

            if (isset($info[$key_link]) && $info[$key_link] == '#') {
                header("Location: {$redirect_to}?msg=not-start");
                exit();
            }
        }

        /**
         * Winner
         */
        function get_winners()
        {
            global $lotte_winners;

            if (isset($lotte_winners)) {
                return $lotte_winners;
            }

            $route = '/user/winner';

            if ($this->is_lang('en')) {
                $route .= '?lang=en';
            }

            $response = $this->api_request($route);

            if (isset($response['code']) && $response['code'] == 200 && isset($response['items'])) {
                $lotte_winners = $response['items'];
            } else {
                $lotte_winners = [];
            }

            return $lotte_winners;
        }

        /**
         * Luxury
         */
        function get_list_luxury()
        {
            global $lotte_list_luxury;

            if (isset($lotte_list_luxury)) {
                return $lotte_list_luxury;
            }

            $route = '/luxury-list';

            if ($this->is_lang('en')) {
                $route .= '?lang=en';
            }

            $response = $this->api_request($route);

            if (isset($response['code']) && $response['code'] == 200 && isset($response['items'])) {
                $lotte_list_luxury = $response['items'];
            } else {
                $lotte_list_luxury = [];
            }

            return $lotte_list_luxury;
        }

        /**
         * Page
         */
        function get_page($name = '')
        {
            if ($name == '') return false;

            global $lotte_pages;

            if (empty($lotte_pages)) {
                $lotte_pages = [];
            } else if (isset($lotte_pages[$name])) {
                return $lotte_pages[$name];
            }

            $route = '/page/' . $name;

            if ($this->is_lang('en')) {
                $route .= '?lang=en';
            }

            $response = $this->api_request($route);

            if (isset($response['code']) && $response['code'] == 200 && isset($response['item'])) {
                $lotte_pages[$name] = $response['item'];
            } else {
                return false;
            }

            return $lotte_pages[$name];
        }

        /**
         * Game
         */
        function get_game_token()
        {
            return $this->get_token();
        }

        function get_activity_info($lang = '')
        {
            global $lotte_activity_info;

            if (isset($lotte_activity_info)) {
                return $lotte_activity_info;
            }

            $info = [
                "survey_expires" => -1,
                "survey_link" => '#',
                "survey_start" => 'not use',
                "survey_stop" => 'not use',

                "survey_brand_expires" => -1,
                "survey_brand_link" => '#',
                "survey_brand_start" => 'not use',
                "survey_brand_stop" => 'not use',

                "contest_expires" => -1,
                "contest_link" => '#',
                "contest_start" => 'not use',
                "contest_stop" => 'not use',

                "game_expires" => -1,
                "game_link" => '#',
                "game_start" => 'not use',
                "game_stop" => 'not use',
            ];

            $user = $this->get_current_user();
            if ($user == false) {
                return $info;
            }

            $time = $this->get_time();

            foreach ($info as $key => $value) {
                if (isset($user[$key])) {
                    $value = $user[$key];
                }

                $info[$key] = $value;
            }

            extract($info);

            if ($survey_expires == 0 || $survey_expires < $time) {
                $info['survey_link'] = ($lang != '' ? '/' . $lang : '') . '/survey';
            }

            if ($survey_brand_expires == 0 || $survey_brand_expires < $time) {
                $info['survey_brand_link'] = ($lang != '' ? '/' . $lang : '') . '/brand-ambassador';
            }

            if ($contest_expires == 0 || $contest_expires < $time) {
                $info['contest_link'] = ($lang != '' ? '/' . $lang : '') . '/photo-contest';
            }

            if ($game_expires == 0 || $game_expires < $time) {
                $info['game_link'] = ($lang != '' ? '/' . $lang : '') . '/game';
            }

            $lotte_activity_info = $info;

            return $info;
        }

        // For Dev
        function get_game_results($args = [])
        {
            global $lotte_game_results;

            if (isset($lotte_game_results)) {
                return $lotte_game_results;
            }

            // localhost
            if ($_SERVER['REMOTE_ADDR'] == '::1') {
                return '{"code":401, "messages":"Localhost can not run"}';
            }

            $file_env = APP_PATH . 'game-api/.env';
            if (file_exists($file_env) == false) {
                return [];
            }

            $env = parse_ini_file($file_env);
            if (empty($env['API_AUTH_USER']) || empty($env['API_AUTH_PASSWD'])) {
                return [];
            }

            $headers = [
                'Accept: application/json',
                'X-Auth-Token: ' . base64_encode($env['API_AUTH_USER'] . ':' . $env['API_AUTH_PASSWD'])
            ];

            $authorization = $this->get_header('authorization');
            if ($authorization != '') {
                $headers[] = 'Authorization: ' . $authorization;
            }

            $url = $this->get_domain() . '/game-api/manage/game-scores';

            if (count($args) > 0) {
                $url .= '?' . http_build_query($args, '', '&');
            }

            $response = $this->curl_send($url, [], $headers);
            if ($response == '') {
                return [];
            }

            $response = json_decode($response, true);
            if (isset($response['statusCode']) && $response['statusCode'] == 200 && is_array($response['data'])) {
                // $lotte_game_results = $response['data'];
            } else {
                return [];
            }

            return $lotte_game_results;
        }

        function get_csrf()
        {
            if (empty($_SESSION['csrf_token'])) {
                session_start();
            }

            $exp = !empty($_SESSION['csrf_exp']) ? (int) $_SESSION['csrf_exp'] : 0;

            if (empty($_SESSION['csrf_token']) || $exp < time()) {
                // bin2hex(random_bytes(32));

                $_SESSION['csrf_token'] = md5(uniqid(mt_rand(), true));
                $_SESSION['csrf_exp'] = strtotime('+20 minutes');
            }

            return $_SESSION['csrf_token'];
        }

        function check_csrf($csrf_token = '')
        {
            if (empty($_SESSION['csrf_token'])) {
                session_start();
            }

            return empty($_SESSION['csrf_token']) || $_SESSION['csrf_token'] === $csrf_token;
        }

        function get_var($name = '', $default = '', $type = 'GET')
        {
            if ($name == '') return null;

            $value = $default;

            $data = $type == 'POST' ? $_POST : $_GET;

            if (isset($data[$name])) {
                $value = $data[$name];
            }

            if ($name == 'redirect_to' && preg_match('/(signin|signup)/i', $value)) {
                $value = $default;
            }

            return $value;
        }

        function is_mustbuy_coming_soon($mustbuy_from = '', $mustbuy_to = '')
        {
            global $mustbuy_coming_soon;

            if(isset($mustbuy_coming_soon)) return $mustbuy_coming_soon;

            $mustbuy_coming_soon = false;

            $user = $this->get_current_user();

            // Check time in program
            $time_from    = strtotime($mustbuy_from);
            $time_to      = strtotime($mustbuy_to);
            $time_now     = $this->get_time();
            if($time_from <= $time_now && $time_now <= $time_to) {
                $mustbuy_coming_soon = false;
            } else if ($user == false || empty($user['lucky_luxury'])) {
                $mustbuy_coming_soon = true;
            }

            // staging
            if(ISSTG) {
                $mustbuy_coming_soon = !empty($_GET['coming-soon']);
            }

            return $mustbuy_coming_soon;
        }
    }

    $lotte_api = new lotte_api();

endif;
