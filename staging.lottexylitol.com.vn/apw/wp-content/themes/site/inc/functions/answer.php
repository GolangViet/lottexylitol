<?php
/*
* Creating a database
*/
function site_answer_admin_init()
{
    $user = wp_get_current_user();
    if ( ! in_array( 'administrator', $user->roles ) || get_option('tbuseranswer') != '') {
        return;
    }

    $site_create_useranswer = isset($_REQUEST['site_create_useranswer']) ? $_REQUEST['site_create_useranswer'] : 0;
    if( $site_create_useranswer == date('Ymd') ) {
        site_answer_create_table();
    }

	add_settings_field(
		'site_useranswer',
		__( 'User Answer', 'site' ),
		function(){
            echo '<a href="'.add_query_arg(['site_create_useranswer' => date('Ymd')]).'">Create Table</a>'; 
        },
		'reading',
		'default',
		array()
	);
}
add_action('admin_init', 'site_answer_admin_init');

function site_answer_create_table()
{
    global $wpdb;

    $sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}useranswer` (
        `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `name` varchar(500) NOT NULL,
        `email` varchar(500) NOT NULL,
        `phone` varchar(20) NOT NULL,
        `address` text NOT NULL,
        `city` varchar(100) NOT NULL,
        `gender` varchar(20) NOT NULL,
        `age` varchar(20) NOT NULL,
        `survey_id` bigint NOT NULL,
        `answers` text NOT NULL,
        `utm` text NULL,
        `user_id` bigint NOT NULL,
        `created` datetime NOT NULL
    );";

    update_option('tbuseranswer', current_time('mysql'));

    return $wpdb->query($sql);
}

function site_answer_get_fields($type = '')
{
    $fields = array(
        'name'          => '',
        'email'         => '',
        'phone'         => '',
        'address'       => '',
        'city'          => '',
        'gender'        => '',
        'age'           => '',
        'survey_id'     => 0,
        'answers'       => '',
        'utm'           => '',
        'user_id'       => 0,
        'created'       => ''
    );

    if ($type == 'name') {
        $fields = array_keys($fields);
    }

    return $fields;
}

function site_answer_insert_item($data = [])
{
    global $wpdb;

    $fields = site_answer_get_fields();

    $data = shortcode_atts($fields, $data);

    if($data['created'] == '') {
        $data['created'] = current_time('mysql');
    }

    $type = array_map(function(){ return '%s'; }, $fields); 

    $wpdb->insert(
        $wpdb->prefix . 'useranswer',
        $data,
        $type
    );
    
    return $wpdb->insert_id;
}

function site_answer_get_items($args = [])
{
    global $wpdb;

    $tbl_name = $wpdb->prefix . 'useranswer';

    extract(shortcode_atts(array(
        'survey_id' => '',
        'user_id' => 0,
        'day' => '',
        'limit' => 0,
        'paged' => 1,
        'last_days' => 0,
    ), $args));

    $query = $wpdb->prepare("SELECT * FROM %i ", $tbl_name);

    $wheres = [];

    if($survey_id != '') {
        $wheres[] = sprintf("`survey_id` IN (%s)", $survey_id);
    }

    if($user_id>0) {
        $wheres[] = $wpdb->prepare("`user_id` = %d ", $user_id);
    }

    if ($last_days > 0){
        $day = date('Y-m-d', strtotime('-' . $last_days . ' days'));
        
        $wheres[] = "`created` >= '$day' ";
    } else if(strpos($day, '-') > 0){
        $day = substr($day, 0, 10);

        $wheres[] = "DATE_FORMAT(`created`, '%Y-%m-%d') = '$day' ";
    }

    $where = '';

    if(count($wheres)>0) {
        $where = ' WHERE ' . implode(' AND ', $wheres);

        $query .= $where;
    }

    $total_items = 0;

    if($limit > 0) {
        if($paged < 1) {
            $paged = 1;
        }

        $query .= sprintf(" LIMIT %d, %d", ($paged - 1) * $limit, $limit);

        $total_items = (int) $wpdb->get_var($wpdb->prepare('SELECT count(*) FROM %i ' . $where, $tbl_name));
    }

    // The Query.
    $results = $wpdb->get_results($query, ARRAY_A);

    $list = array();

    if ( count($results)>0 ) {
        $fields = array_merge(['id' => ''], site_answer_get_fields());

        // unset($fields['user_id']);
        unset($fields['survey_id']);
        unset($fields['answers']);

        foreach ($results as $result) {
            $item = shortcode_atts($fields, $result);

            $item['survey'] = get_the_title($result['survey_id']);
            // $item['created'] = site_get_date($result['created']);

            $item['survey_responses'] = site_answer_get_survey_responses($result['answers']);

            $list[] = $item;
        }
    }

    $data = [
        'items' => $list,
        'total_items' => count($list),
        'total_pages' => 1,
    ];

    if($total_items > 0) {
        $data['total_items'] = $total_items;
        $data['total_pages'] = ceil($total_items / $limit);
    }

    return $data;
}

function site_answer_validate_data($data = [])
{
    $response = [];
    $errors = [];
    $answers = [];
    $skip = false;

    $items = site_survey_get_items($data['survey_id']);

    foreach($items as $item) {
        $value = isset($data[$item['id']]) ? $data[$item['id']] : '';
        if($value != '') {
            foreach($item['answers'] as $answer) {
                if($answer['key'] == $value && isset($answer['data']) && $answer['data'] == 'skip') {
                    $skip = true;

                    break;
                }
            }
        }

        if($skip) {
            break;
        }
    }

    foreach($items as $item) {
        $answers[] = $item['name'];
        $value = isset($data[$item['id']]) ? $data[$item['id']] : '';
        
        if($value!='') {
            if(in_array($item['type'], ['textarea', 'input'])){
                $answers[] = '- ' . $value;
            } else {
                $values = explode(',', $value);
    
                foreach($values as $v) {
                    foreach($item['answers'] as $answer) {
                        if($answer['key'] == $v) {
                            $v = $answer['label'];
                            break;
                        }
                    }
    
                    $answers[] = '- ' . $v;
                }
            }
        } else if($item['required'] && $skip == false){
            $errors[$item['id']] = 'Empty';
        }
    }

    if(count($answers)>0) {
        $response['answers'] = implode("\n", $answers);
    }

    if(count($errors)>0) {
        $response['errors'] = $errors;
    }

    return $response;
}

/**
 * data JSON request from CDP
 */
function site_answer_get_survey_responses($answers = '')
{
    $list = [];

    $index = -1;

    $rows = explode("\n", $answers);

    foreach($rows as $row) {
        $row = trim($row);

        if(substr($row,0,1) == '-') {
            $list[$index]['answers'][] = trim(substr($row,1));
        } else {
            $index++;

            $list[$index] = [
                'answers' => [],
                'question' => $row,
            ];
        }
    }

    return $list;
}

function site_answer_delete_user($id = 0)
{
    if($id == 0) return ;

    global $wpdb;

    $wpdb->delete($wpdb->prefix . 'useranswer', array('user_id' => $id));
}
add_action('deleted_user', 'site_answer_delete_user');