<?php

if(empty($_GET['abs']) || trim($_GET['abs']) != 'dev') die();

$file = dirname(__DIR__) . '/apw/wp-load.php';
if (!file_exists($file)) die();

// /** Make sure that the WordPress bootstrap has run before continuing. */
require_once($file);

// set offset to test
function test_pre_option_timezone_string() { return ''; }
function test_pre_option_gmt_offset() { return isset($_GET['offset']) ? (int) $_GET['offset'] : 24; }
if(isset($_GET['offset'])) {
    add_filter('pre_option_timezone_string', 'test_pre_option_timezone_string');
    add_filter('pre_option_gmt_offset', 'test_pre_option_gmt_offset');
}

$list = [];

for($i = 1; $i < 100; $i++) {
    $file_path = get_theme_file_path('/inc/data/list-'.$i.'.php');
    if(file_exists($file_path)) {
        require_once($file_path);

        if(function_exists('site_data_get_list_random')) {
            $list = site_data_get_list_random();

            break;
        }
    }
}

$count = count($list);

global $lucky_list_random_from, $lucky_list_random_to, $wpdb;

$lucky = Lucky_Lotte::instance();

if(!empty($_GET['check']) && trim($_GET['check']) == 'thong-ke') {
    $limit = !empty($_GET['limit']) ? (int) $_GET['limit'] : 5;

    if($limit > 20 || $limit < 0)  {
        $limit = 5;
    }

    // $query = $wpdb->prepare("SELECT * FROM %i WHERE `meta_key` = %s AND `meta_value` != %s ORDER BY umeta_id DESC LIMIT 10", $wpdb->usermeta, 'lucky_status', 'completed');

    $query = $wpdb->prepare("SELECT `user_id`, `status`, `modified` FROM %i WHERE `status` IN ('fill-blank', 'lucky') ORDER BY `modified` DESC LIMIT %d", $lucky->get_table('code'),  $limit);

    $results = $wpdb->get_results($query, ARRAY_A);

    echo '<pre>';
    var_export($results);
    echo '</pre>';

    exit();
}

$timezone_string = get_option( 'timezone_string' );

echo 'Today: <b>' . current_time('Y-m-d H:i:s') . "</b> (timezone_string: $timezone_string)<br>\n";
echo 'Data: <b>list-' . $i . "</b><br>\n";
echo 'Total prizes: <b' . ($count == 0 ? ' style="color: red"' : '') . '">' . ($count == 0 ? 'No data' : $count) . "</b><br>\n";

$gifts = $lucky->get_gifts();

// $rates = $lucky->get_rates('today');

// get_rates
$today = !empty($_GET['today']) ? trim($_GET['today']) : '';
if ($today == '' || strlen($today) < 10) {
    $today = current_time('Y-m-d');
}
$date_format = '%Y-%m-%d';
$query = $wpdb->prepare("SELECT * FROM %i WHERE DATE_FORMAT(`date_from`, %s) <= %s AND %s <= DATE_FORMAT(`date_to`, %s)", $lucky->get_table('rates'), $date_format, $today, $today, $date_format);
$results = $wpdb->get_results($query, ARRAY_A);
$rates = [];
if (count($results) > 0) {
    foreach ($results as $result) {
        $rates[$result['gift_id']] = $result;
    }
}
// end get_rates

$from = '';
$to = '';

foreach ($rates as $item) {
    $from   = $item['date_from'];
    $to     = $item['date_to'];

    break;
}

$args = [];

if($from != '' && $to != '') {
    $args = [
        'from' 	=> $from,
        'to' 	=> $to,
    ];
}

$lucky_list_random_from = $from;
$lucky_list_random_to = $to;

$custom_total = $lucky->get_list_random_total();

$total = $lucky->count_results();

$max = end($list);

$rows = [];

$list_ids = [];

if(!empty($_GET['check']) && trim($_GET['check']) == 'data' && $from != '' && $to != '') {
    $query = $wpdb->prepare("SELECT id FROM %i WHERE gift_id != 5 ", $lucky->get_table('results'));

    $where = $wpdb->prepare(" AND %s <= `created` AND `created` <= %s ", $from, $to);

    $list_ids = $wpdb->get_col($query . $where);

    $query . $where;

    $query = $wpdb->prepare("SELECT min(id) FROM %i WHERE gift_id > 0 ", $lucky->get_table('results'));
    
    $min_id = (int) $wpdb->get_var($query . $where);

    if($min_id > 1) {
        foreach($list_ids as $i => $id) {
            $list_ids[$i] = $id - $min_id + 1;
        }
    }
}

$info = '';

$count_won = 0;
$count_gift = 0;

$prev = -1;

for($i = 1; $i <= $max + 10; $i++) {
    $more = in_array($i, $list_ids) ? 'data' : '';
    
    $index = $i - 1;

    if(in_array($index, $list)) {
        if($i <= $custom_total) {
            $count_won++;
        }

        $count_gift++;

        $warning = '';

        // kiem tra 3 vi tri truoc
        for($j = $index - 1; $j > $index - 3; $j--) {
            if(in_array($j, $list)) {
                $warning = " - <b style=\"color: red\">Warning ( $j,)</b>";
                break;
            }
        }

        $prev = $i;
        
        $rows[] = $i . " - Trúng quà ($count_gift) <b>$more</b>" . $warning;

        if($info == '' && $i == $custom_total) {
            $info = 'Trúng quà';
        }
    } else if($more != ''){
        $rows[] = $i . " <b style='color: red'>$more</b>";
    } else {
        // $rows[] = $i . " - ";
    }
    
    if($info == '' && $i == $custom_total) {
        $info = 'Chúc may mắn';
    }
}

echo "Rate: <b>$from</b> - <b>$to</b> <br>\n";
echo "Custom Total results: <b>$custom_total</b> <b style='color: red'>($info)</b> !<br>\n";
echo "Total results: <b>$total</b> <br>\n";
echo "Total won: <b>$count_won</b> <br>\n";
echo "<hr>\n";
echo implode("<br>\n", $rows);
echo "<hr>Còn lại là Chúc may mắn lần sau<br>\n";