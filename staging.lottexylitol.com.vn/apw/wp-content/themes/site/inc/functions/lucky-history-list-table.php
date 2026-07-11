<?php
defined('ABSPATH') or die;

/*************************** LOAD THE BASE CLASS *******************************
 *******************************************************************************
 * The WP_List_Table class isn't automatically available to plugins, so we need
 * to check if it's available and load it if necessary. In this tutorial, we are
 * going to use the WP_List_Table class directly from WordPress core.
 *
 * IMPORTANT:
 * Please note that the WP_List_Table class technically isn't an official API,
 * and it could change at some point in the distant future. Should that happen,
 * I will update this plugin with the most current techniques for your reference
 * immediately.
 *
 * If you are really worried about future compatibility, you can make a copy of
 * the WP_List_Table class (file path is shown just below) to use and distribute
 * with your plugins. If you do that, just remember to change the name of the
 * class to avoid conflicts with core.
 *
 * Since I will be keeping this tutorial up-to-date for the foreseeable future,
 * I am going to work with the copy of the class provided in WordPress core.
 */
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

/************************** CREATE A PACKAGE CLASS *****************************
 *******************************************************************************
 * Create a new list table package that extends the core WP_Users_List_Table class.
 * WP_Users_List_Table contains most of the framework for generating the table, but we
 * need to define and override some methods so that our data can be displayed
 * exactly the way we need it to be.
 * 
 * To display this example on a page, you will first need to instantiate the class,
 * then call $yourInstance->prepare_items() to handle any data manipulation, then
 * finally call $yourInstance->display() to render the table to the page.
 * 
 * Our theme for this list table is going to be movies.
 */
class Site_Lucky_History_List_Table extends WP_List_Table
{
    protected $tbl_name = 'lucky_history';

    protected $history_action = 'code-error';

    protected $history_actions = ['code-error', 'fill-blank', 'user-locked'];

    /** ************************************************************************
     * REQUIRED. Set up a constructor that references the parent constructor. We 
     * use the parent reference to set some default configs.
     ***************************************************************************/
    function __construct()
    {
        $action = isset($_REQUEST['action']) ? sanitize_text_field($_REQUEST['action']) : '';
        if(in_array($action, $this->history_actions)) {
            $this->history_action = $action;
        }

        //Set parent defaults
        parent::__construct(array(
            'singular'  => 'customer',     //singular name of the listed records
            'plural'    => 'result',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ));
    }

    /** ************************************************************************
     * Recommended. This method is called when the parent class can't find a method
     * specifically build for a given column. Generally, it's recommended to include
     * one method for each column you want to render, keeping your package class
     * neat and organized. For example, if the class needs to process a column
     * named 'title', it would first see if a method named $this->column_title() 
     * exists - if it does, that method will be used. If it doesn't, this one will
     * be used. Generally, you should try to use custom column methods as much as 
     * possible. 
     * 
     * Since we have defined a column_title() method later on, this method doesn't
     * need to concern itself with any column with a name of 'title'. Instead, it
     * needs to handle everything else.
     * 
     * For more detailed insight into how columns are handled, take a look at 
     * WP_List_Table::single_row_columns()
     * 
     * @param array $item A singular item (one full row's worth of data)
     * @param array $column_name The name/slug of the column to be processed
     * @return string Text or HTML to be placed insIDe the column <td>
     **************************************************************************/
    function column_default($item = [], $column_name = '', $type = 'table')
    {
        switch ($column_name) {
            case 'id':
                return (int) $item[$column_name];
            case 'name':
            case 'phone':
            case 'email':
            case 'address':
            case 'age':
            case 'error_times':
                $user_info = json_decode($item['user_info'], true);

                $value = isset($user_info[$column_name]) ? $user_info[$column_name] : '';

                if($column_name == 'address' && isset($user_info['city'])) {
                    $value .= ', ' . $user_info['city'];
                } elseif($column_name == 'error_times') {
                    $value = 'Lần ' . $value;
                }

                return $value;
            case 'unlock_by':
                $user_info = json_decode($item['user_info'], true);

                if(!empty($user_info[$column_name])) {
                    $user = get_userdata($user_info[$column_name]);

                    return isset($user->display_name) ? $user->display_name : 'User Deleted';
                }

                return '';
            case 'history_code':
                $value = isset($item['description']) ? $item['description'] : '';

                if($type == 'table') {
                    $value = sprintf('<input readonly value="%s" />', $value);
                }

                return $value;
            case 'unlock_time':
                $user_info = json_decode($item['user_info'], true);

                $value = isset($user_info[$column_name]) ? $user_info[$column_name] : '';

                if($value == '' && $type == 'table') {
                    $value = sprintf('<a href="%s" onclick="return confirm(\'Are you sure to unlock?\')"><b>%s</b></a>', add_query_arg(array_merge($_GET, ['unlock_id' => $item['id'], 'nonce' => wp_create_nonce('unlock-nonce')]), ), 'Unlock Now');
                }

                return $value;
            case 'email':
                $user = get_userdata($item['user_id']);
                return isset($user->user_email) ? $user->user_email : 'User Deleted';
            default:
                return isset($item[$column_name]) ? $item[$column_name] : '';
        }
    }

    /** ************************************************************************
     * Recommended. This is a custom column method and is responsible for what
     * is rendered in any column with a name/slug of 'title'. Every time the class
     * needs to render a column, it first looks for a method named 
     * column_{$column_title} - if it exists, that method is run. If it doesn't
     * exist, column_default() is called instead.
     * 
     * This example also illustrates how to implement rollover actions. Actions
     * should be an associative array formatted as 'slug'=>'link html' - and you
     * will need to generate the URLs yourself. You could even ensure the links
     * 
     * 
     * @see WP_List_Table::::single_row_columns()
     * @param array $item A singular item (one full row's worth of data)
     * @return string Text to be placed inside the column <td> (movie title only)
     **************************************************************************/
    function column_title($item = [])
    {
        $args = $_GET;

        $args['id'] = $item['id'];

        //Build row actions
        $actions = array(
            'detail' => '<a href="' . add_query_arg(array_merge($args, ['action' => 'detail'])) . '">' . __('Detail', 'site') . '</a>',
            // 'delete' => '<a href="'. add_query_arg(array_merge($args,['action'=>'delete', 'nonce' => wp_create_nonce('delete-nonce')])).'">'.__('Delete','site').'</a>',
        );

        //Return the title contents
        return sprintf(
            '%1$s %2$s',
            /*$1%s*/
            $item['post_title'],
            /*$2%s*/
            $this->row_actions($actions)
        );
    }


    /** ************************************************************************
     * REQUIRED if displaying checkboxes or using bulk actions! The 'cb' column
     * is given special treatment when columns are processed. It ALWAYS needs to
     * have it's own method.
     * 
     * @see WP_List_Table::::single_row_columns()
     * @param array $item A singular item (one full row's worth of data)
     * @return string Text to be placed insIDe the column <td> (movie title only)
     **************************************************************************/
    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/
            $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/
            $item['id']                //The value of the checkbox should be the record's ID
        );
    }


    /** ************************************************************************
     * REQUIRED! This method dictates the table's columns and titles. This should
     * return an array where the key is the column slug (and class) and the value 
     * is the column's title text. If you need a checkbox for bulk actions, refer
     * to the $columns array below.
     * 
     * The 'cb' column is treated differently than the rest. If including a checkbox
     * column in your table you must create a column_cb() method. If you don't need
     * bulk actions or checkboxes, simply leave the 'cb' entry out of your array.
     * 
     * @see WP_List_Table::::single_row_columns()
     * @return array An associative array containing column information: 'slugs'=>'Visible Titles'
     **************************************************************************/
    function get_columns()
    {
        $columns = array(
            'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
            'id'        => 'ID',
            'created'   => 'Created',
            'user_id'   => 'User ID',
            'name'      => 'Name',
            'phone'     => 'Phone',
            'email'     => 'Email',
            'address'   => 'Address',
            'age'       => 'Age',
        );

        if($this->history_action == 'code-error') {
            $columns['history_code'] = 'Lucky Code';
            $columns['error_times'] = 'Status';
        } else if($this->history_action == 'user-locked') {
            $columns = array(
                'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
                'id'        => 'ID',
                'created'   => 'Locked time',
                'user_id'   => 'User ID',
                'name'      => 'Name',
                'unlock_time' => 'Unlocked time',
                'unlock_by' => 'Unlocked by',
            );
        }

        return $columns;
    }


    /** ************************************************************************
     * Optional. If you want one or more columns to be sortable (ASC/DESC toggle), 
     * you will need to register it here. This should return an array where the 
     * key is the column that needs to be sortable, and the value is db column to 
     * sort by. Often, the key and value will be the same, but this is not always
     * the case (as the value is a column name from the database, not the list table).
     * 
     * This method merely defines which columns should be sortable and makes them
     * clickable - it does not handle the actual sorting. You still need to detect
     * the ORDERBY and ORDER querystring variables within prepare_items() and sort
     * your data accordingly (usually by modifying your query).
     * 
     * @return array An associative array containing all the columns that should be sortable: 'slugs'=>array('data_values',bool)
     **************************************************************************/
    function get_sortable_columns()
    {
        //true means it's already sorted
        $sortable_columns = array(
            // 'ID'        => array('ID', false),
            // 'name'      => array('name', false),
            // 'created'   => array('created', false)
        );

        return $sortable_columns;
    }


    /** ************************************************************************
     * Optional. If you need to include bulk actions in your list table, this is
     * the place to define them. Bulk actions are an associative array in the format
     * 'slug'=>'Visible Title'
     * 
     * If this method returns an empty value, no bulk action will be rendered. If
     * you specify any bulk actions, the bulk actions box will be rendered with
     * the table automatically on display().
     * 
     * Also note that list tables are not automatically wrapped in <form> elements,
     * so you will need to create those manually in order for bulk actions to function.
     * 
     * @return array An associative array containing all the bulk actions: 'slugs'=>'Visible Titles'
     **************************************************************************/
    function get_bulk_actions()
    {
        $actions = array(
            // 'delete'	=> 'Delete',
        );
        return $actions;
    }


    /** ************************************************************************
     * Optional. You can handle your bulk actions anywhere or anyhow you prefer.
     * For this example package, we will handle it in the class to keep things
     * clean and organized.
     * 
     * @see $this->prepare_items()
     **************************************************************************/
    function process_bulk_action()
    {
        if ($this->user_can_export() == false) {
            return;
        }

        $class = 'notice-success';
        $message = '';
        $action = strtolower(str_replace(' ', '', $this->current_action()));

        //Detect when a bulk action is being triggered...
        if ('delete' == $action) {
            // nonce
            $nonce = isset($_GET['nonce']) ? sanitize_text_field($_GET['nonce']) : '';
            if ($nonce == '' || !wp_verify_nonce($nonce, 'delete-nonce')) {
                $class = 'notice-warning';
                $message = 'Delete token not verify!';
            } else if ($this->delete_item() ==  false) {
                $class = 'notice-error';
                $message = 'Data NULL';
            } else {
                $message = 'Data deleted.';
            }
        } else if (!empty($_GET['unlock_id'])) {
            // nonce
            $nonce = isset($_GET['nonce']) ? sanitize_text_field($_GET['nonce']) : '';
            if ($nonce == '' || !wp_verify_nonce($nonce, 'unlock-nonce')) {
                $class = 'notice-warning';
                $message = 'Unlock token not verify!';
            } else if ($this->unlock_item($_GET['unlock_id']) ==  false) {
                $class = 'notice-error';
                $message = 'User NULL';
            } else {
                $message = 'User has been unlocked!';
            }
        }

        if ($message != '') {
            echo '<div id="message" class="notice ' . esc_attr($class) . ' is-dismissible">
				' . __($message, 'site') . '<button type="button" class="notice-dismiss"><span class="screen-reader-text">' . __('Dismiss this notice.') . '</span></button>
			</div>';
        }
    }

    function get_where_action()
    {
        global $wpdb;

        return $wpdb->prepare(" WHERE action = %s ", $this->history_action);
    }

    /** ************************************************************************
     * REQUIRED! This is where you prepare your data for display. This method will
     * usually be used to query the database, sort and filter the data, and generally
     * get it ready to be displayed. At a minimum, we should set $this->items and
     * $this->set_pagination_args(), although the following properties and methods
     * are frequently interacted with here...
     * 
     * @global WPDB $wpdb
     * @uses $this->_column_headers
     * @uses $this->items
     * @uses $this->get_columns()
     * @uses $this->get_sortable_columns()
     * @uses $this->get_pagenum()
     * @uses $this->set_pagination_args()
     **************************************************************************/
    function prepare_items()
    {
        global $wpdb; //This is used only if making any database queries

        /**
         * First, lets decide how many records per page to show
         */
        $per_page = $this->get_current_user_screen_meta('per_page', 20);
        if (isset($_POST['per_page']) && intval($_POST['per_page']) > 0) {
            $per_page = (int) $_POST['per_page'];
            $this->update_current_user_screen_meta('per_page', $per_page);
        }

        /**
         * REQUIRED. Now we need to define our column headers. This includes a complete
         * array of columns to be displayed (slugs & titles), a list of columns
         * to keep hidden, and a list of columns that are sortable. Each of these
         * can be defined in another method (as we've done here) before being
         * used to build the value for our _column_headers property.
         */
        $columns = $this->get_columns();
        $where = '';
        $hidden = array();
        $sortable = $this->get_sortable_columns();


        /**
         * REQUIRED. Finally, we build an array to be used by the class for column 
         * headers. The $this->_column_headers property takes an array which contains
         * 3 other arrays. One for all columns, one for hidden columns, and one
         * for sortable columns.
         */
        $this->_column_headers = array($columns, $hidden, $sortable);

        /**
         * Optional. You can handle your bulk actions however you see fit. In this
         * case, we'll handle them within our package just to keep things clean.
         */
        $this->process_bulk_action();

        /**
         * Instead of querying a database, we're going to fetch the example data
         * property we created for use in this plugin. This makes this example 
         * package slightly different than one you might build on your own. In 
         * this example, we'll be using array manipulation to sort and paginate 
         * our data. In a real-world implementation, you will probably want to 
         * use sort and pagination data to build a custom query instead, as you'll
         * be able to use your precisely-queried data immediately.
         */
        //$data = $this->example_data;


        /***********************************************************************
         * ---------------------------------------------------------------------
         * vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
         * 
         * In a real-world situation, this is where you would place your query.
         *
         * For information on making queries in WordPress, see this Codex entry:
         * http://codex.wordpress.org/Class_Reference/wpdb
         * 
         * ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
         * ---------------------------------------------------------------------
         **********************************************************************/
        $table = $wpdb->prefix . $this->tbl_name;

        $where = $this->get_where_action();

        $search = isset($_REQUEST['s']) ? sanitize_text_field($_REQUEST['s']) : '';
        if ($search != '') {
            $search = '%' . $wpdb->esc_like($search) . '%';

            $where .= $wpdb->prepare(" AND (`description` LIKE %s OR `user_info` LIKE %s)", $search, $search);
        }

        /**
         * REQUIRED for pagination. Let's figure out what page the user is currently 
         * looking at. We'll need this later, so you should always include it in 
         * your own package classes.
         */
        $current_page = (int) $this->get_pagenum();

        /**
         * REQUIRED for pagination. Let's check how many items are in our data array. 
         * In real-world use, this would be the total number of items in your database, 
         * without filtering. We'll need this later, so you should always include it 
         * in your own package classes.
         */
        $total_items = (int) $wpdb->get_var($wpdb->prepare('SELECT count(*) FROM %i ' . $where, $table));

        /**
         * The WP_List_Table class does not handle pagination for us, so we need
         * to ensure that the data is trimmed to only the current page. We can use
         * array_slice() to 
         */
        //$data = array_slice($data,(($current_page-1)*$per_page),$per_page);

        $query = $wpdb->prepare(' SELECT * FROM %i ' . $where . ' ORDER BY `id` DESC LIMIT %d, %d', $table, ($current_page - 1) * $per_page, $per_page);

        $this->items = $wpdb->get_results($query, ARRAY_A);

        $total_pages = 0;
        if ($total_items > 0 && $per_page > 0) {
            $total_pages = ceil($total_items / $per_page);
        }

        /**
         * REQUIRED. We also have to register our pagination options & calculations.
         */
        $this->set_pagination_args(array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => $total_pages   //WE have to calculate the total number of pages
        ));
    }

    /**
     * 
     * @return boolean;
     */
    function delete_item()
    {
        return false;
    }

    /**
     * @params $id;
     * 
     * @return array();
     */
    function get_item($id = 0)
    {
        global $wpdb;

        $query = $wpdb->prepare("SELECT * FROM %i WHERE id = %d ", $wpdb->prefix . $this->tbl_name, $id);

        return $wpdb->get_row($query, ARRAY_A);
    }

    /**
     * @params $id;
     * 
     * @return array();
     */
    function unlock_item($id = 0)
    {
        global $wpdb;

        $query = $wpdb->prepare("SELECT * FROM %i WHERE id = %d ", $wpdb->prefix . $this->tbl_name, $id);

        $item = $wpdb->get_row($query, ARRAY_A);

        if(!empty($item['user_id']) && function_exists('site_lucky_lotte_update_meta')) {
            if(site_api_must_buy_is_locked_user($item['user_id']) == false) return true;

            // reset 
            if(site_lucky_lotte_update_meta($item['user_id'], ['input_error' => 0])) {
                $user_info = json_decode($item['user_info'], true);

                $user_info['unlock_time'] = current_time('mysql');
                $user_info['unlock_by'] = get_current_user_id();
                
                $info = json_encode($user_info, JSON_UNESCAPED_UNICODE);

                return $wpdb->update($wpdb->prefix . $this->tbl_name, ['user_info' => $info], ['id' => $id], ['%s'], ['%d']);
            }
        }

        return false;
    }

    function get_current_user_screen_meta($key, $default)
    {
        $current_user = wp_get_current_user();

        $v = (string) get_user_meta($current_user->ID, 'screen_meta_userlucky_' . $key, $single = true);
        if ($v && $v != '') {
            if (is_array($default)) {
                $v = json_decode($v);
                if (is_object($v)) {
                    $v = get_object_vars($v);
                }
            } else if (is_numeric($default)) {
                $v = (int) $v;
            }
            return $v;
        }

        return $default;
    }

    function update_current_user_screen_meta($key,  $value)
    {
        $current_user = wp_get_current_user();

        if (empty($current_user->ID)) return false;

        return update_user_meta($current_user->ID, 'screen_meta_userlucky_' . $key, json_encode($value));
    }

    function extra_tablenav( $which ) {
        if ($this->user_can_export() == false) {
            return;
        }

        if($which == 'top') {
            echo '<label>'. __('From', 'site'). '</label><input type="date" name="lucky_history_export_from" /> ';
            echo '<label>'. __('To', 'site'). '</label><input type="date" name="lucky_history_export_to" /> ';
            echo '<button type="submit" name="lucky_history_export" class="button action" value="csv">'. __('Export CSV', 'site'). '</button>';
        }
    }

    /**
     * @custom functions;
     */
    function user_can_export()
    {
        $user = wp_get_current_user();

        return !empty($user->roles) && is_array($user->roles) && in_array('administrator', $user->roles);
    }

    function export_csv()
    {
        if ($this->user_can_export() == false) {
            return;
        }
        
        global $wpdb;

        $data = wp_unslash($_REQUEST);

        $page       = isset($data['page']) ? sanitize_text_field($data['page']) : '';
        $date_from  = isset($data['lucky_history_export_from']) ? sanitize_text_field($data['lucky_history_export_from']) : '';
        $date_to    = isset($data['lucky_history_export_to']) ? sanitize_text_field($data['lucky_history_export_to']) : '';
        $action     = isset($data['action']) ? sanitize_text_field($data['action']) : '';

        $query = $wpdb->prepare("SELECT * FROM %i ", $wpdb->prefix . $this->tbl_name);
        
        $query .= $this->get_where_action();

        if ($date_from != '') {
            $query .= $wpdb->prepare(" AND DATE_FORMAT(`created`, %s) >= %s", '%Y-%m-%d', $date_from);
        }
        
        if ($date_to != '') {
            $query .= $wpdb->prepare(" AND DATE_FORMAT(`created`, %s) <= %s", '%Y-%m-%d', $date_to);
        }

        $items = $wpdb->get_results($query, ARRAY_A);

        $rows = [];

        $fields = $this->get_columns();
        unset($fields['cb']);

        $rows[] = implode(',', array_map('ucwords', array_values($fields)));

        $keys = array_keys($fields);

        if($items && count($items) > 0) {
            foreach ($items as $i => $item) {
                $columns = [];

                foreach ($keys as $key) {
                    $columns[$key] = $this->column_default($item, $key, 'csv');
                }

                if(isset($columns['id'])) {
                    $columns['id'] = $i + 1;
                }
                
                $rows[] = '"' . implode('","', $columns) . '"';
            }
        }

        $content = implode("\n", $rows);        

        site_csv_download($page . ($action != '' ? '-' . $action : '') . '-' . time() . '.csv', $content);
    }
}

/**
 * List page
 *
 * @since 1.1.1
 *
 */
function site_lucky_history_list_page_admin_init()
{
    $data = wp_unslash($_GET);

    $lucky_history_export = isset($data['lucky_history_export']) ? sanitize_text_field($data['lucky_history_export']) : '';
    if($lucky_history_export == 'csv') {
        $site_lucky_history_table = new Site_Lucky_History_List_Table();

        $site_lucky_history_table->export_csv();
    }
}
add_action('admin_init', 'site_lucky_history_list_page_admin_init');

/**
 * List page
 *
 * @since 1.1.1
 *
 */
function site_lucky_history_render_list_page()
{
    global $site_lucky_history_table;

    $data = wp_unslash($_GET);

    $action     = isset($data['action']) ? sanitize_text_field($data['action']) : '';
    $id         = isset($data['id']) ? intval($data['id']) : 0;
    $page       = isset($data['page']) ? sanitize_text_field($data['page']) : '';
    $uri        = explode('?', $_SERVER['REQUEST_URI']);

    $title = 'Lucky Code Log';

    $list = site_activities_get_menus();
    foreach($list as $item) {
        if($item[2] == $page) {
            $title = $item[0];
            break;
        }
    }

    //Create an instance of our package class...
    $site_lucky_history_table = new Site_Lucky_History_List_Table();

    if ($id > 0 && $action == 'detail') :

        $item = $site_lucky_history_table->get_item($id);
    ?>
        <h1><?php esc_attr_e($title, 'site') ?></h1>
    <?php
        site_lucky_history_render_detail($item);
    else :
        //Fetch, prepare, sort, and filter our data...
        $site_lucky_history_table->prepare_items();
    ?>
        <style>
            td.column-history_code input{
                border-color: transparent;
                max-width: 100%;
            }
            tr:hover td.column-history_code input{
                border-color: red;
            }
        </style>
        <h1><?php esc_attr_e($title, 'site') ?></h1>

        <?php site_lucky_history_render_submenu($uri[0]); ?>

        <?php add_thickbox(); ?>

        <div class="wrap-list-table">
            <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
            <form id="history-filter" method="get">
                <!-- For plugins, we also need to ensure that the form posts back to our current page -->
                <input type="hidden" name="page" value="<?php echo esc_attr($page); ?>" />
                <input type="hidden" name="action" value="<?php echo esc_attr($action); ?>" />
                <?php $site_lucky_history_table->search_box('Search', 'name'); ?>
                <!-- Now we can render the completed list table -->
                <?php $site_lucky_history_table->display() ?>
            </form>
        </div>
        <script>
            document.querySelectorAll('td.column-history_code input').forEach(item => {
                item.addEventListener('focus', function() {
                    this.select();
                })
            })
        </script>
    <?php
    endif;
}


function site_lucky_history_render_submenu($url = '')
{
    $data = wp_unslash($_GET);

    $page   = isset($data['page']) ? sanitize_text_field($data['page']) : '';
    $action = isset($data['action']) ? sanitize_text_field($data['action']) : 'code-error';

    $submenu = [
        'code-error' => 'Lỗi nhập lucky code', // __('Code Error', 'Site'),
        'fill-blank' => 'Hoàn thành fill blank', // __('Fill Blank', 'Site'),
        'user-locked' => 'Khóa user', // __('Fill Blank', 'Site'),
    ];

    $i = 0;

    ?>
    <ul class="subsubsub">
        <?php foreach($submenu as $name => $title) : 
            $args = ['page' => $page];
            
            if($name != 'result') {
                $args['action'] = $name;
            }
        ?>
        <li>
            <a <?php echo $action == $name ? 'class="current"' : '' ?> href="<?php echo esc_url(add_query_arg($args, $url)) ?>"><?php echo esc_attr($title) ?></a>
            <?php
                echo ++$i < count($submenu) ? ' |' : ''
            ?>
        </li>
        <?php endforeach ?>
    </ul>
    <div class="clear"></div>
    <?php
}

/**
 * Detail form
 *
 * @since 1.1.2
 *
 * @param object $item 
 */
function site_lucky_history_render_detail($item)
{
    global $site_lucky_history_table;

    $data = wp_unslash($_GET);

    $page = sanitize_text_field(isset($data['page']) ? $data['page'] : '');
    $uri = explode('?', $_SERVER['REQUEST_URI']);

    $columns = $site_lucky_history_table->get_columns();
    unset($columns['cb']);
    ?>
    <div class="site_lucky_history_detail">
        <table class="form-table" role="presentation">
            <?php foreach($columns as $name => $label) : ?>
            <tr>
                <th scope="row"><label><?php esc_attr_e($label) ?></label></th>
                <td><?php esc_attr_e(isset($item[$name]) ? $item[$name] : '') ?></td>
            </tr>
            <?php endforeach ?>
        </table>
        <p class="buttons">
            <a class="button button-secondary" href="<?php echo esc_url(add_query_arg(['page' => $page], $uri[0])); ?>"><?php _e('Back', 'site'); ?></a>
        </p>
    </div>
    <?php
}