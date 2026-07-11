<?php
/**
 * class Lucky_Lotte
 * 
 * https://developer.wordpress.org/reference/classes/wpdb
 * 
 * global $wpdb;
 * 
 * function flock();
 * 
 */
class Lucky_Lotte
{
	protected $debug = false;

	protected $user_id = 0;

	protected $user = null;

	// 1 user trung toi da {value} giai trong toan thoi gian
	protected $max_prize_for_user = -1; // {value} = -1 : unlimited

	function __construct($args = [])
	{
		$this->update_vars($args);
	}

	static function instance($args = [])
	{
		global $lucky_lotte;

		if (empty($lucky_lotte)) {
			$lucky_lotte = new Lucky_Lotte($args);
		} else {
			$lucky_lotte->update_vars($args);
		}

		return $lucky_lotte;
	}

	function update_vars($args = [])
	{
		if(isset($args['debug'])) {
			$this->debug = $args['debug'];
		}

		if(isset($args['user']) && is_object($args['user'])) {
			$this->user = $args['user'];

			$this->user_id = $args['user']->ID;
		}

		if(isset($args['user_id'])) {
			$this->user_id = $args['user_id'];
		}

		if(isset($args['max_prize_for_user'])) {
			$this->max_prize_for_user = $args['max_prize_for_user'];
		}
	}

	function get_table($name = '')
	{
		global $wpdb;

		return $wpdb->prefix . 'lucky_' . $name;
	}

	function get_statuses($key = '')
	{
		$list = [
			'none' => 'Chưa kích hoạt',
			'fill-blank' => 'Câu hỏi',
			'lucky' => 'Vòng quay',
			'cancel' => 'Bỏ cuộc',
			'completed' => 'Hoàn thành'
		];

		if ($key != '') {
			return isset($list[$key]) ? $list[$key] : '';
		}

		return array_keys($list);
	}

	function get_code_status_used()
	{
		return [
			'cancel',
			'completed',
		];
	}

	function get_user_id()
	{
		// $user_id = get_current_user_id();

		// $user_id = 1;

		// $user_id = rand(1, 10);

		return $this->user_id;
	}

	function limit($args = [])
	{
		if (!empty($args['limit'])) {
			global $wpdb;

			$offset = empty($args['offset']) ? 0 : intval($args['offset']);

			return $wpdb->prepare(" LIMIT %d, %d", $offset, $args['limit']);
		}

		return '';
	}

	function orderby($args = [])
	{
		if (!empty($args['orderby'])) {
			$orderby = sanitize_text_field($args['orderby']);
			if($orderby == 'rand') {
				return ' ORDER BY RAND()';
			}

			$order = empty($args['order']) ? '' : strtoupper(sanitize_text_field($args['order']));

			if(!in_array($order, ['ASC', 'DESC'])) {
				$order = 'DESC';
			}

			return sprintf(" ORDER BY %s %s", $orderby, $order);
		}

		return '';
	}

	/**
	 * gift
	 */
	function get_gift($args = [])
	{
		global $wpdb;

		$query = $wpdb->prepare("SELECT * FROM %i WHERE 1", $this->get_table('gifts'));

		$query .= $this->where_gift($args);

		$item = $wpdb->get_row($query, ARRAY_A);

		return $item;
	}

	function get_gifts($args = [])
	{
		global $wpdb, $lucky_gifts;

		if(!empty($lucky_gifts)) {
			return $lucky_gifts;
		}

		$query = $wpdb->prepare("SELECT * FROM %i WHERE 1", $this->get_table('gifts'));

		$query .= $this->where_gift($args);

		$results = $wpdb->get_results($query, ARRAY_A);

		$items = [];

		if (count($results) > 0) {
			foreach ($results as $result) {
				$items[$result['id']] = $result;
			}
		}

		$lucky_gifts = $items;

		return $items;
	}

	function where_gift($args = [])
	{
		global $wpdb;

		$query = '';

		if (!empty($args['id'])) {
			$query .= $wpdb->prepare(" AND `id` = %s", $args['id']);
		}

		if (!empty($args['type'])) {
			if($args['type'] == 'not empty') {
				$query .= " AND `type` != ''";
			} else {
				$query .= $wpdb->prepare(" AND `type` = %s", $args['type']);
			}
		}

		return $query;
	}

	function is_gift_try_again($gift = [])
	{
		return !empty($gift['title']) && $gift['title'] === 'try again';
	}

	/**
	 * rates
	 */
	function get_rates($type = 'today')
	{
		global $wpdb, $lucky_rates;

		$today = current_time('Y-m-d');

		if(!empty($lucky_rates[$today])) {
			return $lucky_rates[$today];
		}

		$query = $wpdb->prepare("SELECT * FROM %i", $this->get_table('rates'));

		if($type == 'today') {
			$date_format = '%Y-%m-%d';

			$query .= $wpdb->prepare(" WHERE DATE_FORMAT(date_from, %s) <= %s AND %s <= DATE_FORMAT(date_to, %s)", $date_format, $today, $today, $date_format);
		}

		$query .= " LIMIT 0, 3000";

		$results = $wpdb->get_results($query, ARRAY_A);

		$items = [];

		if (count($results) > 0) {
			if($type == 'today') {
				foreach ($results as $result) {
					$items[$result['gift_id']] = $result;
				}
			} else {
				foreach ($results as $result) {
					$items[] = $result;
				}
			}
		}

		$lucky_rates[$today] = $items;

		return $items;
	}

	/**
	 * code
	 */
	function insert_code($data = [])
	{
		global $wpdb;

		$item = shortcode_atts([
			'code' => '',
			'status' => 'none',
			'user_id' => 0,
			'created' => current_time('mysql'),
		], $data);

		if (empty($item['code'])) return 0;

		$format = array_map(function(){return '%s';}, $item);

		$wpdb->insert($this->get_table('code'), $item, $format);

		return $wpdb->insert_id;
	}

	function update_code($item = [], $where = [])
	{
		global $wpdb;

		$data = shortcode_atts([
			'status' => '',
			'user_id' => $this->user_id,
			'modified' => current_time('mysql'),
		], $item);

		$format = array_map(function(){return '%s';}, $item);

		$where_format = [];

		foreach ($where as $value) {
			$where_format[] = is_numeric($value) ? '%d' : '%s';
		}

		return $wpdb->update($this->get_table('code'), $data, $where, $format, $where_format);
	}

	function get_code($args = [])
	{
		global $wpdb;

		$query = $wpdb->prepare("SELECT * FROM %i WHERE 1", $this->get_table('code'));

		$query .= $this->where_code($args);

		$item = $wpdb->get_row($query, ARRAY_A);

		return $item;
	}

	function get_codes($args = [])
	{
		global $wpdb;

		$query = $wpdb->prepare("SELECT * FROM %i WHERE 1", $this->get_table('code'));

		$query .= $this->where_code($args);

		$query .= $this->orderby($args);

		$query .= $this->limit($args);

		$results = $wpdb->get_results($query, ARRAY_A);

		return $results;
	}

	function where_code($args = [])
	{
		global $wpdb;

		$query = '';

		if (!empty($args['status'])) {
			$query .= $wpdb->prepare(" AND `status` = %s", $args['status']);
		}

		if (!empty($args['code'])) {
			$query .= $wpdb->prepare(" AND `code` = %s", $args['code']);
		}

		if (isset($args['user_id'])) {
			$query .= $wpdb->prepare(" AND `user_id` = %d", intval($args['user_id']));
		}

		if (isset($args['user_codes'])) {
			$query .= $wpdb->prepare(" AND `user_id` = %d", $this->user_id);

			$value = implode("','", $this->get_code_status_used());

			$query .= sprintf(" AND `status` NOT IN ('%s')", $value);
		}

		return $query;
	}

	function check_code($code = '')
	{
		$item = $this->get_code(['code' => $code]);

		if(empty($item['status'])) return [];

		if(empty($item['user_id'])) return $item;

		if($item['user_id'] != $this->user_id) return [];

		return $item;
	}

	/**
	 * results
	 */
	function insert_result($data = [])
	{
		global $wpdb;

		$item = shortcode_atts([
			'code' => '',
			'gift_id' => 0,
			'name' => '',
			'status' => 1,
			'user_id' => $this->user_id,
			'user_code' => '',
			'token'	=> '',
			'code_entered_time'	=> '',
			'created' => current_time('mysql'),
		], $data);

		if($this->user_id > 0 && function_exists('site_user_get_info')) {
			if(empty($this->user->ID)) {
				$this->user = get_user_by('ID', $this->user_id);
			}

			$info = site_user_get_info($this->user, 'info');

			$item['user_name'] = !empty($info['name']) ? $info['name'] : '';
			$item['user_email'] = !empty($info['email']) ? $info['email'] : '';
			$item['user_phone'] = !empty($info['phone']) ? $info['phone'] : '';
			$item['user_gender'] = !empty($info['gender']) ? $info['gender'] : '';
			$item['user_age'] = !empty($info['age']) ? $info['age'] : '';
			$item['user_address'] = (!empty($info['address']) ? $info['address'] : '') . ', ' 
								. (!empty($info['city']) ? $info['city'] : '');
			$item['utm'] = !empty($info['utm']) ? $info['utm'] : '';
		}

		$format = array_map(function(){return '%s';}, $item);

		$wpdb->insert($this->get_table('results'), $item, $format);

		return $wpdb->insert_id;
	}

	function where_results($args = [])
	{
		global $wpdb;

		$date_format = '%Y-%m-%d';

		$query = '';

		if (!empty($args['code'])) {
			$query .= $wpdb->prepare(" AND `code` = %s", $args['code']);
		}

		if (!empty($args['gift_id'])) {
			$query .= $wpdb->prepare(" AND `gift_id` = %d", $args['gift_id']);
		}

		if (!empty($args['gift_ids'])) {
			$query .= sprintf(" AND `gift_id` IN (%s)", implode(',', $args['gift_ids']));
		}

		if (isset($args['status'])) {
			$query .= $wpdb->prepare(" AND `status` = %d", intval($args['status']));
		}

		if (!empty($args['user_id'])) {
			$query .= $wpdb->prepare(" AND `user_id` = %d", intval($args['user_id']));
		}

		if (!empty($args['user_id_not_in'])) {
			$query .= sprintf(" AND `user_id` NOT IN (%s)", implode(',', $args['user_id_not_in']));
		}

		if (!empty($args['user_code'])) {
			$query .= $wpdb->prepare(" AND `user_code` = %s", $args['user_code']);
		}

		if (!empty($args['user_email'])) {
			$query .= $wpdb->prepare(" AND `user_email` = %s", $args['user_email']);
		}

		if (!empty($args['from'])) {
			if(strlen($args['from']) > 10) {
				$args['from'] = date('Y-m-d', strtotime($args['from']));
			}

			$query .= $wpdb->prepare(" AND DATE_FORMAT(created, %s) >= %s", $date_format, $args['from']);
		}

		if (!empty($args['to'])) {
			if(strlen($args['to']) > 10) {
				$args['to'] = date('Y-m-d', strtotime($args['to']));
			}

			$query .= $wpdb->prepare(" AND DATE_FORMAT(created, %s) <= %s", $date_format, $args['to']);
		}

		return $query;
	}

	function get_results($args = [])
	{
		global $wpdb;

		$query = $wpdb->prepare("SELECT * FROM %i WHERE 1", $this->get_table('results'));

		$query .= $this->where_results($args);

		$query .= $this->orderby($args);

		$query .= $this->limit($args);

		$results = $wpdb->get_results($query, ARRAY_A);

		return $results;
	}

	function count_results($args = [])
	{
		global $wpdb;

		$query = $wpdb->prepare("SELECT COUNT(*) FROM %i WHERE 1", $this->get_table('results'));

		$query .= $this->where_results($args);

		return (int) $wpdb->get_var($query);
	}

	function statistic_results($args = [])
	{
		global $wpdb;

		$query = $wpdb->prepare("SELECT `gift_id`, COUNT(*) as `total` FROM %i WHERE 1", $this->get_table('results'));

		$query .= $this->where_results($args);

		$query .= ' GROUP BY `gift_id`';

		$results = $wpdb->get_results($query, ARRAY_A);

		$items = [];

		if (count($results) > 0) {
			foreach ($results as $result) {
				$items[$result['gift_id']] = $result['total'];
			}
		}

		return $items;
	}

	/**
	 * history
	 */
	function insert_history($data = [])
	{
		global $wpdb;

		$item = shortcode_atts([
			'action' => '',
			'description' => '',
			'user_info' => '',
			'user_id' => $this->user_id,
			'created' => current_time('mysql'),
		], $data);

		if(is_array($item['user_info'])) {
			// $user_info = $this->get_history_user_info_fields($item['user_info']);

			$item['user_info'] = json_encode($item['user_info'], JSON_UNESCAPED_UNICODE);
		}

		if (empty($item['action'])) return 0;

		$format = array_map(function(){return '%s';}, $item);

		$wpdb->insert($this->get_table('history'), $item, $format);

		return $wpdb->insert_id;
	}

	function get_history_user_info_fields($data = [])
	{
		$fields = array(
			"name" => '',
			"email" => '',
			"phone" => '',
			"address" => '',
			"city" => '',
			"age" => '',
		);

		if(count($data) > 0) {
			$fields = shortcode_atts($fields, $data);
		}

		return $fields;
	}

	/**
	 * luxury
	 */
	function insert_luxury($data = [])
	{
		global $wpdb;

		$item = shortcode_atts([
			'user_id' 		=> '',
			'user_name' 	=> '',
			'user_email' 	=> '',
			'user_phone' 	=> '',
			'user_code' 	=> '',
			'user_gender' 	=> '',
			'user_address' 	=> '',
			'user_age' 		=> '',
			'token' 		=> '',
			'created_by' 	=> $this->user_id,
		], $data);

		$item['created'] = current_time('mysql');

		// foreach($item as $value) {
		// 	if($value == '') {
		// 		return 0;
		// 	}
		// }

		$format = array_map(function(){return '%s';}, $item);

		$wpdb->insert($this->get_table('luxury'), $item, $format);

		return $wpdb->insert_id;
	}

	function get_list_luxury($args = [])
	{
		global $wpdb;

		$query = $wpdb->prepare("SELECT * FROM %i WHERE 1", $this->get_table('luxury'));

		$query .= $this->where_luxury($args);

		$query .= $this->orderby($args);

		$query .= $this->limit($args);

		$results = $wpdb->get_results($query, ARRAY_A);

		return $results;
	}

	function count_luxury($args = [])
	{
		global $wpdb;

		$query = $wpdb->prepare("SELECT COUNT(*) FROM %i WHERE 1", $this->get_table('luxury'));

		$query .= $this->where_luxury($args);

		return (int) $wpdb->get_var($query);
	}

	function where_luxury($args = [])
	{
		global $wpdb;

		$query = '';

		if (!empty($args['user_code'])) {
			$query .= $wpdb->prepare(" AND `user_code` = %s", $args['user_code']);
		}

		$date_format = '%Y-%m-%d';

		if (!empty($args['from'])) {
			$query .= $wpdb->prepare(" AND DATE_FORMAT(created, %s) >= %s", $date_format, $args['from']);
		}

		if (!empty($args['to'])) {
			$query .= $wpdb->prepare(" AND DATE_FORMAT(created, %s) <= %s", $date_format, $args['to']);
		}
		
		if (isset($args['user_id'])) {
			$query .= $wpdb->prepare(" AND `user_id` = %d", intval($args['user_id']));
		}

		return $query;
	}

	/**
	 * Status
	 */
	function insert_status($data = [])
	{
		global $wpdb;

		$item = shortcode_atts([
			'status' => '',
			'prizes' => '',
			'fill-blank' => '',
			'user_id' => 0,
			'user_name' => '',
		], $data);

		if (empty($item['user_id'])) return 0;

		$format = array_map(function(){return '%s';}, $item);

		$wpdb->insert($this->get_table('status'), $item, $format);

		return $wpdb->insert_id;
	}

	function update_status($item = [], $where = [])
	{
		global $wpdb;

		$item = shortcode_atts([
			'status' => '',
			'prizes' => '',
			'fill-blank' => '',
		], $item);

		$data = [];

		foreach($item as $key => $value) {
			if($value != '') {
				$data[$key] = $value;
			}
		}

		if(count($data) == 0) return false;

		$format = array_map(function(){return '%s';}, $data);

		$where_format = [];

		foreach ($where as $value) {
			$where_format[] = is_numeric($value) ? '%d' : '%s';
		}

		return $wpdb->update($this->get_table('status'), $data, $where, $format, $where_format);
	}

	/**
	 * random gift
	 */
	function random_gift($args = [])
	{
		if (empty($args['code'])) return ['code' => 403, 'message' => 'No code to run'];

		$code = $args['code'];

		$this->update_log('BEGIN LUCKY');

		// Lấy danh sách tỉ lệ theo lịch bởi today
		$rates = $this->get_rates('today');
		if (count($rates) == 0) return ['code' => 404, 'message' => 'No rate to run'];

		if ($this->user_id == 0) return ['code' => 400, 'message' => 'No permission to run'];

		if ($this->count_results(['code' => $code]) > 0) return ['code' => 404, 'message' => 'This code has already been used'];

		// Lấy danh sách quà
		$gifts = $this->get_gifts();
		if (count($gifts) == 0) return ['code' => 404, 'message' => 'No gift to run'];

		// get lock
		$this->lock(true);

		// thống kê số quà của user đã nhận
		$user_statistic = $this->statistic_results(['user_id' => $this->user_id]);

		// giới hạn số lượng qùa của user
		$gift_exceeded_limit = [];

		if(count($user_statistic) > 0) {
			foreach($gifts as $gift_id => $gift) {
				$total = !empty($user_statistic[$gift_id]) ? (int) $user_statistic[$gift_id] : 0;

				if($gift['user_limit'] > 0 && $total >= $gift['user_limit']) {
					$gift_exceeded_limit[] = $gift_id;
				}
			}
		}

		$this->update_log(['user_gift_limit' => $gift_exceeded_limit]);

		$from = '';
		$to = '';

		foreach ($rates as $gift_id => $item) {
			// Lấy tổng và tỉ lệ từng quà
			$item['total'] 	= strpos($item['total'], '.') > 0 ? floatval($item['total']) : intval($item['total']);
			$item['rate'] 	= strpos($item['rate'], '.') > 0  ? floatval($item['rate']) : intval($item['rate']);
			$item['rate_t2']= strpos($item['rate_t2'], '.') > 0 ? floatval($item['rate_t2']) : intval($item['rate_t2']);

			if($from == '' || $from > $item['date_from']) {
				$from = $item['date_from'];
			}

			if($to == '' || $to < $item['date_to']) {
				$to = $item['date_to'];
			}

			$rates[$gift_id] = $item;
		}

		$this->update_log(['rates' => $rates]);

		// Thống kê số quà theo lịch bởi today
		$calendar_statistic = $this->statistic_results([
			'from' 	=> $from,
			'to' 	=> $to,
		]);

		// Thống kê số quà chung
		$full_statistic = $this->statistic_results();

		if ($this->debug) {
			// var_dump(['statistic' => $calendar_statistic]);
		}

		$user_can_get_rates = [];

		foreach ($rates as $gift_id => $item) {
			// gift empty
			if(empty($gifts[$gift_id])) continue;

			$gift = $gifts[$gift_id];

			// Không cho nhận quà này vì vượt qua giới hạn
			if (count($gift_exceeded_limit) > 0 && in_array($gift_id, $gift_exceeded_limit)) {
				continue;
			}

			// Lấy tổng quà của bảng tỉ lệ theo lịch
			$calendar_total = isset($calendar_statistic[$gift_id]) ? (int) $calendar_statistic[$gift_id] : 0;

			// không giới hạn quà (chúc may mắn lần sau) nếu khác mới kiểm tra số quà đã trúng
			if ($this->is_gift_try_again($gift) == false) {
				// 
				// if($this->max_prize_for_user > -1) {
				// 	continue;
				// }

				// Lấy tổng quà của bảng chung
				$full_total = isset($full_statistic[$gift_id]) ? (int) $full_statistic[$gift_id] : 0;

				// Kiểm tra số quà thống kê với số tổng của bảng chung
				if ($full_total >= $gift['total']) {
					continue;
				}

				// Kiểm tra số quà thống kê với số tổng của bảng tỉ lệ theo lịch
				if ($calendar_total >= $item['total']) {
					continue;
				}

				// Dùng tỉ lệ theo số quà còn lại
				$item['rate'] = $item['total'] - $calendar_total;
			}

			$item['gift'] = $gift;

			$user_can_get_rates[] = $item;
		}

		$this->update_log(['user_can_get_rates' => $user_can_get_rates]);

		$response = ['code' => 404, 'message' => 'No gift to run'];

		if (count($user_can_get_rates) > 0) {
			global $lucky_list_random_from, $lucky_list_random_to;

			$lucky_list_random_from = $from;
			$lucky_list_random_to = $to;

			$gift_tickets = $this->random_gift_tickets($user_can_get_rates);

			$index = rand(0, count($gift_tickets) - 1);

			$result = $gift_tickets[$index];

			$user_code = '';

			$i = 0;
			while($i++ < 10) {
				$value = $this->random_code(10, 'all');
				if($value != '' && $this->count_results(['user_code' => $value]) == 0) {
					$user_code = $value;
					break;
				}
			}

			if($user_code != '') {
				$result['user_code'] = $user_code;

				$token = md5($result['user_code'] . '.gift' . $result['id'] . '.' . $user_code);

				$result['new'] = $this->insert_result([
					'code' 		=> $code,
					'code_entered_time'	=> isset($args['code_entered_time']) ? $args['code_entered_time'] : '', // 
					'user_code'	=> $user_code,
					'gift_id'	=> $result['gift_id'],
					'name' 		=> $result['name'],
					'token' 	=> $token,
				]);
			}

			if(!empty($result['new'])) {
				$this->update_code(['status' => 'completed'], ['code' => $code]);

				$this->update_list_random_total();

				$response = ['code' => 200, 'result' => $result, 'message' => 'Request success'];
			} else {
				$response = ['code' => 500, 'message' => 'Request fail'];
			}
		}

		do_action('class_lucky_lotte_random_gift_completed', $this->user_id, $response);

		$this->update_log(['response' => $response], true);

		// release lock
		$this->lock(false);

		return $response;
	}

	/**
	 * Update - get list random
	 * 
	 */
	function random_gift_tickets($rates = [], $rate_type = 1)
	{
		$rates = $this->filter_random_gift_tickets($rates);

		$list = [];

		$rate_key = 'rate';

		if($rate_type == 2) {
			$rate_key = 'rate_t2';
		}

		foreach ($rates as $item) {
			$total = $item[$rate_key];
			
			if(strpos($total, '.') > -1) {
				$total *= 1000;
			}

			for ($i = 0; $i < $item[$rate_key]; $i++) {
				$list[] = $item;
			}
		}

		$n = count($list);

		for ($i = 0; $i < $n - 1; $i++) {
			$rand = rand($i, $n - 1);
			if ($rand != $i) {
				$tmp = $list[$rand];
				$list[$rand] = $list[$i];
				$list[$i] = $tmp;
			}
		}

		return $list;
	}

	function random_code($length = 8, $uppercase = '')
	{
		global $site_codes;

		if (empty($site_codes)) $site_codes = [];

		$chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
		$n = strlen($chars);
		$text = '';

		if($uppercase == 'all') {
			$chars = strtoupper($chars);
		}

		for ($i = 0; $i < $length; $i++) {
			$char = substr($chars, rand(0, $n - 1), 1);

			if ($uppercase == 'rand' && rand(0, 1) == 1) {
				$char = strtoupper($char);
			}

			$text .= $char;
		}

		if (isset($site_codes[$text])) {
			return $this->random_code($length, $uppercase);
		}

		$site_codes[$text] = 1;

		return $text;
	}

	function is_use_list_random($return_type = '')
	{
		for($i = 1; $i < 100; $i++) {
			$file_path = get_theme_file_path('/inc/data/list-'.$i.'.php');
			if(file_exists($file_path)) {
				if($return_type == 'index') {
					return $i;
				}

				return true;
			}
		}

		return false;
	}

	function filter_random_gift_tickets($rates = [])
	{
		$file_path = get_theme_file_path('/inc/data/before-action.php');
		if(file_exists($file_path)) {
			require_once($file_path);

			if(function_exists('site_data_before_get_list_random')) {
				site_data_before_get_list_random();
			}
		}

		for($i = 1; $i < 100; $i++) {
			$file_path = get_theme_file_path('/inc/data/list-'.$i.'.php');
			if(file_exists($file_path)) {
				require_once($file_path);
			
				if(function_exists('site_data_get_list_random')) {
					$list = site_data_get_list_random();

					$total = $this->get_list_random_total();

					$new_rates = [];

					// trung giai
					if(in_array($total, $list)) {
						foreach($rates as $item) {
							if($this->is_gift_try_again($item['gift']) == false) {
								$new_rates[] = $item;
							}
						}
					}
					
					// Chuc may man lan sau
					if(count($new_rates) == 0){
						foreach($rates as $item) {
							if($this->is_gift_try_again($item['gift']) === true) {
								$new_rates[] = $item;
								break;
							}
						}
					}

					// file_put_contents(WP_CONTENT_DIR . '/uploads/new_rates-' .time() .'.log', json_encode($new_rates));

					return $new_rates;
				}
			}
		}

		return $rates;
	}

	function get_list_random_option_name()
	{
		global $lucky_list_random_from;

		$name = 'lucky_random_total';

		if(!empty($lucky_list_random_from)) {
			$name .= '_' . substr($lucky_list_random_from, 0, 10);
		}

		return $name;
	}

	function get_list_random_total()
	{
		global $lucky_list_random_update_total, $lucky_list_random_from, $lucky_list_random_to;

		// $total = (int) get_option($this->get_list_random_option_name(), 0);

		$args = [];

		if (!empty($lucky_list_random_from) && !empty($lucky_list_random_to)) {
			$args = [
				'from' 	=> $lucky_list_random_from,
				'to' 	=> $lucky_list_random_to,
			];
		}

		$total = $this->count_results($args);

		// $lucky_list_random_update_total = $total + 1;

		return $total;
	}

	function update_list_random_total()
	{
		global $lucky_list_random_update_total;
		if(isset($lucky_list_random_update_total)) {
			update_option($this->get_list_random_option_name(), $lucky_list_random_update_total);
		}
	}

	/**
	 * random luxury
	 */
	function random_luxury()
	{
		// Lấy danh sách tỉ lệ theo lịch bởi today
		// $rates = $this->get_rates();
		// if (count($rates) == 0) return ['code' => 404, 'message' => 'No rate to run'];

		$gift = $this->get_gift(['type' => 'lucky-card']);
		if (empty($gift['id'])) return ['code' => 404, 'message' => 'No gift to run'];

		// get lock
		$this->lock(true, 'luxury');

		$this->update_log('BEGIN LUXURY');

		// $from = '';
		// $to = '';

		// foreach ($rates as $item) {
		// 	if($from == '' || $from > $item['date_from']) {
		// 		$from = $item['date_from'];
		// 	}

		// 	if($to == '' || $to < $item['date_to']) {
		// 		$to = $item['date_to'];
		// 	}
		// }

		// $date_where = [
		// 	'from' 	=> $from,
		// 	'to' 	=> $to,
		// ];
	
		// $list_luxury = $this->get_list_luxury($date_where);

		// get full
		$list_luxury = $this->get_list_luxury();

		// danh sach user da trung thuong
		$list_user_ids = [];

		if(count($list_luxury) > 0) {
			foreach($list_luxury as $luxury) {
				$list_user_ids[] = $luxury['user_id'];
			}
		}

		$results = $this->get_results([
			'gift_id' => $gift['id'],
			'user_id_not_in' => $list_user_ids, // loai user da trung thuong
		]);

		$total = count($results);

		$response = ['code' => 404, 'message' => 'No user to run'];

		if($total > 0) {
			$index = rand(0, $total - 1);

			$result = $results[$index];

			$user_code = '';

			$i = 0;
			while($i++ < 10) {
				$value = $this->random_code(10, 'all');
				if($value != '' && $this->count_luxury(['user_code' => $value]) == 0) {
					$user_code = $value;
					break;
				}
			}

			if($user_code != '') {
				$result['user_code'] = $user_code;

				$result['token'] = md5('phone' . $result['user_phone'] . '.' . $user_code);

				$result['new'] = (int) $this->insert_luxury($result);
			}

			$this->update_log(['result' => $result]);

			if(!empty($result['new'])) {
				$response = ['code' => 200, 'result' => $result, 'message' => 'Request success'];
			} else {
				$response = ['code' => 500, 'result' => $result, 'message' => 'Request fail'];
			}
		}
		
		$this->update_log(['response' => $response], true);

		// release lock
		$this->lock(false, 'luxury');

		return $response;
	}

	/**
	 * lock
	 */
	function lock($isLock = false, $name = 'lucky')
	{
		static $lockhandles = [];
		if ($isLock) {
			// get lock
			if (isset($lockhandles[$name])) return true;
			$filename = strtr(WP_CONTENT_DIR . '/uploads/lock_%1.lock', ['%1' => $name]);
			$lockhandle = fopen($filename, 'c');
			if (!$lockhandle) {
				throw new Exception("lock handle error!");
				return false;
			}
			// ftruncate($lockhandle, 0);      // truncate file
			// fwrite($lockhandle, date('Ymd-His') . "\n");
			// fflush($lockhandle);            // flush output before releasing the lock
			flock($lockhandle, LOCK_EX);
			$lockhandles[$name] = $lockhandle;
			return true;
		} else {
			// release lock
			if (!isset($lockhandles[$name])) return true;
			fclose($lockhandles[$name]);
			unset($lockhandles[$name]);
			return true;
		}
	}

	/**
	 * testing
	 */
	function html_table($items = [])
	{
		if (count($items) == 0) return;

		$html = ['<table class="table" width="100%" border=1>'];

		$i = -1;

		foreach ($items as $item) {
			$i++;
			unset($item['gift_id']);
			// unset($item['date_from']);
			// unset($item['date_to']);

			if ($i == 0) {
				$html[] = '<tr>';
				foreach ($item as $key => $value) {
					$html[] = '<th>' . ucwords(str_replace('_', ' ', $key)) . '</th>';
				}
				$html[] = '</tr>';
			}

			$html[] = '<tr>';
			foreach ($item as $key => $value) {
				$html[] = '<td>' . $value . '</td>';
			}
			$html[] = '</tr>';
		}

		$html[] = '</table>';

		echo implode("\n", $html);
	}

	function update_log($text = '', $write = false) 
	{
		global $lucky_logs;
		
		if(empty($lucky_logs)) return; // tam thoi tat

		if(empty($lucky_logs)) $lucky_logs = [];

		if(is_array($text)) {
			$text = json_encode($text, JSON_UNESCAPED_UNICODE);
		}

		$time = date('Ymd-His');

		$lucky_logs[] = "======== [ $time ] ======";
		$lucky_logs[] = $text;
		$lucky_logs[] = "\n";

		if($write) {
			file_put_contents(WP_CONTENT_DIR . '/uploads/luck_'.date('Ymd-His').'.log', implode("\n", $lucky_logs) );
		}
	}
}