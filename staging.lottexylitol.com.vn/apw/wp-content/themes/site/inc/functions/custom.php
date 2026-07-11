<?php
defined('ABSPATH') or die();

function site__get($name = '', $default = '')
{
	$value = $default;

	if (isset($_GET[$name])) {
		$value = site_sanitize_array_text_field($_GET[$name]);
	}

	return $value;
}

function site_remove_to_tel($value = '')
{
	return str_replace(array('+', '-', '(', ')', ' ', '[', ']'), '', $value);
}

function site_get_all_custom_fields($post)
{
	$custom_keys = get_post_custom_keys($post->ID);
	if (is_array($custom_keys) && count($custom_keys)) {
		foreach ($custom_keys as $key) {
			$valuet = trim($key);
			if ('_' == substr($valuet, 0, 1))
				continue;

			$post->$key = get_post_meta($post->ID, $key, true);
		}
	}

	return $post;
}

function site_get_post_meta_list_keys($post_id, $meta_keys = [])
{
	$list = [];

	$values = [];

	$count = 0;

	foreach($meta_keys as $i => $meta_key) {
		$values[$meta_key] = site_get_post_meta_list($post_id, $meta_key);
		if($i == 0) {
			$count = count($values[$meta_key]);
		}
	}

	for($i = 0; $i < $count; $i++) {
		$items = [];

		foreach($meta_keys as $meta_key) {
			$items[$meta_key] = isset($values[$meta_key][$i]) ? $values[$meta_key][$i] : '';
		}

		$list[] = $items;
	}

	return $list;
}

function site_get_post_meta_list($post_id, $meta_key)
{
	$values = [];

	$custom_keys = get_post_custom_keys($post_id);
	if (is_array($custom_keys) && count($custom_keys)>0) {
		$length = strlen($meta_key);
		foreach ($custom_keys as $key) {
			if (substr(trim($key), 0, $length) == $meta_key) {
				$values[] = get_post_meta($post_id, $key, true);
			}
		}
	}

	return $values;
}

function site_update_post_meta_list($post_id, $meta_key, $values = [])
{
	$total = 0;

	$custom_keys = get_post_custom_keys($post_id);
	if (is_array($custom_keys) && count($custom_keys)>0) {
		$length = strlen($meta_key);
		foreach ($custom_keys as $key) {
			if (substr(trim($key), 0, $length) == $meta_key) {
				$total++;
			}
		}
	}

	$count = count($values);
	if ($count > 0) {
		foreach ($values as $i => $value) {
			update_post_meta($post_id, $meta_key . '_' . $i, $value);
		}
	}

	for ($i = $count; $i < $total; $i++) {
		delete_post_meta($post_id, $meta_key . '_' . $i, '');
	}

	return true;
}

function site_get_youtube_id($url)
{
	$parts = parse_url($url);
	if (isset($parts['query'])) {
		parse_str($parts['query'], $qs);
		if (isset($qs['v'])) {
			return $qs['v'];
		} else if (isset($qs['vi'])) {
			return $qs['vi'];
		}
	}
	if (isset($parts['path'])) {
		$path = explode('/', trim($parts['path'], '/'));
		return $path[count($path) - 1];
	}
	return false;
}

function site_alphabet_text($i = 0)
{
	$char = 'abcdefghijklmnopqrstvwxyz';

	return substr($char, $i, 1);
}

function site_point_format($number = 0)
{
	if ($number == 0) return $number;

	return number_format($number, 0, '.', ',');
}

function site_sanitize_array_text_field($value = '')
{
	if(is_array($value)) {
		foreach($value as $i => $item) {
			$value[$i] = site_sanitize_array_text_field($item);
		}
	} else {
		$value = sanitize_text_field($value);
	}

	return $value;
}

function site_get_date($value = '', $format = 'd / m / Y')
{
	if(strpos($value, '-')>0 || strpos($value, '/')>0) {
		$value = strtotime($value);
	}

	$date = date($format, $value);

	return $date;
}

/**
 * Acquire a file-based lock.
 */
function site_file_update_content($file = '', $content = '')
{
	$update = false;

    $fp = fopen($file, "c+");
	if ( !$fp ) {
		file_put_contents($file, $content);

		$update = true;
	} else {
		if (flock($fp, LOCK_EX)) {  // acquire an exclusive lock
			ftruncate($fp, 0);      // truncate file
			fwrite($fp, $content);
			fflush($fp);            // flush output before releasing the lock
			flock($fp, LOCK_UN);    // release the lock

			$update = true;
		} else {
			throw new Exception('Can\'t lock file!');

			$update = false;
		}
		fclose($fp);
	}

	return $update;
}

function site_csv_download($filename = '', $content = '')
{
	header("Content-Type: text/csv;charset=UTF-8");
    header("Content-Disposition: attachment; filename=$filename");
	
	echo "\xEF\xBB\xBF"; // UTF-8 BOM

	echo $content;

	exit();
}

function site_get_pages_by_post($post = null)
{
	$content = $post->post_content;
	if ( str_contains( $content, '<!--nextpage-->' ) ) {
		$content = str_replace( "\n<!--nextpage-->\n", '<!--nextpage-->', $content );
		$content = str_replace( "\n<!--nextpage-->", '<!--nextpage-->', $content );
		$content = str_replace( "<!--nextpage-->\n", '<!--nextpage-->', $content );

		// Remove the nextpage block delimiters, to avoid invalid block structures in the split content.
		$content = str_replace( '<!-- wp:nextpage -->', '', $content );
		$content = str_replace( '<!-- /wp:nextpage -->', '', $content );

		// Ignore nextpage at the beginning of the content.
		if ( str_starts_with( $content, '<!--nextpage-->' ) ) {
			$content = substr( $content, 15 );
		}

		$pages = explode( '<!--nextpage-->', $content );
	} else {
		$pages = array( $content );
	}

	$pages = apply_filters( 'content_pagination', $pages, $post );

	return $pages;
}

function site_get_html_by_tag($content = '', $tag = '')
{
	$doc = new DOMDocument('1.0');
	$doc->loadHTML('<?xml encoding="UTF-8">' . $content);

	$elements = $doc->getElementsByTagName($tag);
	foreach($elements as $element) {
		return $doc->saveHTML($element);
	}

	return '';
}

function site_curl_send($url = '', $post_data = array(), $headers = array(), $response_type = 'body')
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

	// $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 Edg/103.0.1264.77';

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_AUTOREFERER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	// curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

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
	$header = substr($response, 0, $header_size);
	$body = substr($response, $header_size);

	curl_close($ch);

	if($response_type == 'full') {
        return ['header' => $header, 'body' => $body];
    } else if($response_type == 'header') {
        return $header;
    } else if($response_type == 'body') {
        return $body;
    }

	return $response;
}

function site_get_domain()
{
	return 'http' . (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on" ? 's' : '') . "://" . $_SERVER["HTTP_HOST"];
}

function site_get_header($name = '')
{
	$headers = [];

	foreach (getallheaders() as $key => $value) {
		$headers[strtolower($key)] = $value;
	}

	$name = strtolower(trim($name));
	if($name != '') {
		if (isset($headers[$name])) {
			return $headers[$name];
		}

		return '';
	}

	return $headers;
}

function site_custom_lock($isLock, $task = 'post')
{
	$upload_dir = wp_upload_dir();

    static $lockhandle = false;
    $filename = $upload_dir['basedir'] . '/lock_update_'.$task.'.lock';

    if ($isLock) {
        // get lock
        if ($lockhandle) return true;
        $lockhandle = fopen($filename, 'c');
        if (!$lockhandle) return false;
        flock($lockhandle, LOCK_EX);
        return true;
    } else {
        // release lock
        if (!$lockhandle) return true;
        fclose($lockhandle);
        $lockhandle = false;
        return true;
    }
}

function site_ucwords_utf8($str = '')
{
	return mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
}
