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
class Site_Answer_List_Table extends WP_List_Table
{
    private $tbl_name = 'useranswer';

    /** ************************************************************************
     * REQUIRED. Set up a constructor that references the parent constructor. We 
     * use the parent reference to set some default configs.
     ***************************************************************************/
    function __construct()
    {
        //Set parent defaults
        parent::__construct(array(
            'singular'  => 'customer',     //singular name of the listed records
            'plural'    => 'answers',    //plural name of the listed records
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
     * @return string Text or HTML to be placed inside the column <td>
     **************************************************************************/
    function column_default($item = [], $column_name = '')
    {
        switch ($column_name) {
            case 'id':
                return (int) $item[$column_name];
            case 'name':
                return $this->column_title($item);
            default:
                return isset($item[$column_name]) ? $item[$column_name] : ''; //Show the whole array for troubleshooting purposes
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
            $item['name'],
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
     * @return string Text to be placed inside the column <td> (movie title only)
     **************************************************************************/
    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/
            $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/
            $item['id']                //The value of the checkbox should be the record's id
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
            'user_id'   => 'User ID',
            'name'      => 'Name',
            'email'     => 'Email',
            'phone'     => 'Phone',
            'gender'    => 'Gender',
            'city'      => 'City',
            'age'       => 'Age',
            'created'      => 'Created',
        );

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
            // 'id'        => array('id', false),
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
        }

        if ($message != '') {
            echo '<div id="message" class="notice ' . esc_attr($class) . ' is-dismissible">
				' . __($message, 'site') . '<button type="button" class="notice-dismiss"><span class="screen-reader-text">' . __('Dismiss this notice.') . '</span></button>
			</div>';
        }
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
        global $table_prefix;

        $table = $table_prefix . $this->tbl_name;

        $search = isset($_REQUEST['s']) ? sanitize_text_field($_REQUEST['s']) : ''; //If no sort, default to title

        $where = $wpdb->prepare(" WHERE id > %d ", 0);

        if ($search != '') {
            $text_like = '%' . $wpdb->esc_like($search) . '%';

            $where .= $wpdb->prepare(" AND (`name` LIKE %s OR `phone` LIKE %s) ", $text_like, $text_like);
        }

        $page = isset($_REQUEST['page']) ? sanitize_text_field($_REQUEST['page']) : '';

        $survey_ids = [];

        if($page == 'survey-brand') {
            $survey_ids = site_admin_setting_get_values('survey_brand_id');
        } else {
            // cau hinh rieng cho cdp
            $survey_ids = get_option('cdp_survey_ids', '');

            // neu chua co se lay setting cua trang survey
            if(is_string($survey_ids) && $survey_ids == '') {
                $survey_ids = site_admin_setting_get_values('survey_id');
            }
        }

        if (count($survey_ids) > 0) {
            $where .= sprintf(" AND `survey_id` IN (%s)", implode(',', $survey_ids));
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

        $query = $wpdb->prepare('SELECT * FROM %i ' . $where, $table);
        
        $query .= sprintf(' ORDER BY `id` DESC LIMIT %d, %d', ($current_page - 1) * $per_page, $per_page);

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
        global $wpdb, $table_prefix;

        $table = $table_prefix . $this->tbl_name;

        $query = "SELECT * FROM `$table` WHERE `id`= %d ";

        return $wpdb->get_row($wpdb->prepare($query, $id), ARRAY_A);
    }

    function get_current_user_screen_meta($key, $default)
    {
        $current_user = wp_get_current_user();

        $v = (string) get_user_meta($current_user->ID, 'screen_meta_useranswer_' . $key, $single = true);
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

        return update_user_meta($current_user->ID, 'screen_meta_useranswer_' . $key, json_encode($value));
    }

    function extra_tablenav( $which ) {
        if($which == 'top') {
            echo '<label>'. __('From', 'site'). '</label><input type="date" name="answer_export_from" /> ';
            echo '<label>'. __('To', 'site'). '</label><input type="date" name="answer_export_to" /> ';
            echo '<button type="submit" name="answer_export" class="button action" value="csv">'. __('Export CSV', 'site'). '</button>';
        }
    }

    function get_questions($content_answers = '')
    {
        $questions = [];

        $answers = explode("\n", $content_answers);

        $question = '';
        foreach($answers as $value) {
            if(substr($value,0,1) != '-' && empty($questions[$value])) {
                $questions[$value] = [];
                $question = $value;
            } else if(isset($questions[$question])){
                $questions[$question][] = trim(substr($value,1));
            }
        }

        return $questions;
    }

    function export_csv()
    {
        global $wpdb;

        $table = $wpdb->prefix . $this->tbl_name;

        $_data = wp_unslash($_REQUEST);

        $page = isset($_data['page']) ? sanitize_text_field($_data['page']) : '';
        $date_from  = isset($_data['answer_export_from']) ? sanitize_text_field($_data['answer_export_from']) : '';
        $date_to    = isset($_data['answer_export_to']) ? sanitize_text_field($_data['answer_export_to']) : '';

        $survey_ids = [];

        if($page == 'survey-brand') {
            $survey_ids = site_admin_setting_get_values('survey_brand_id');
        } else {
            // cau hinh rieng cho cdp
            $survey_ids = get_option('cdp_survey_ids', '');

            // neu chua co se lay setting cua trang survey
            if(is_string($survey_ids) && $survey_ids == '') {
                $survey_ids = site_admin_setting_get_values('survey_id');
            }
        }

        $query = sprintf("SELECT * FROM `$table` WHERE `survey_id` IN (%s)", implode(',', $survey_ids));

        if ($date_from != '') {
            $query .= " AND DATE_FORMAT(`created`, '%Y-%m-%d') >= '$date_from'";
        }

        if ($date_to != '') {
            $query .= " AND DATE_FORMAT(`created`, '%Y-%m-%d') <= '$date_to'";
        }

        $items = $wpdb->get_results($query, ARRAY_A);
        
        $rows = [];

        $fields = [
            'user_id',
            'name',
            'email',
            'phone',
            'address',
            'city',
            'gender',
            'age',
            'question',
            'answer',
            'created',
            'utm',
        ];

        $rows[] = implode(',', array_map('ucwords', $fields));

        if($items && count($items)>0) {
            foreach ($items as $item) {
                $columns = [];

                foreach ($fields as $name) {
                    if (isset($item[$name])) {
                        $columns[$name] = str_replace('"', '\"', $item[$name]);
                    } else {
                        $columns[$name] = '';
                    }
                }

                $questions = $this->get_questions($item['answers']);
                foreach ($questions as $question => $answers) {
                    $columns['question'] = $question;
                    $columns['answer'] = str_replace('"', '\"', implode('|', $answers));

                    $rows[] = '"' . implode('","', $columns) . '"';
                    // $rows[] = implode(',', $columns);
                }
            }
        }

        $content = implode("\n", $rows);

        site_csv_download($page . '-' . time() . '.csv', $content);
    }
}

/**
 * List page
 *
 * @since 1.1.1
 *
 */
function site_answer_list_page_admin_init()
{
    $answer_export = isset($_GET['answer_export']) ? sanitize_text_field($_GET['answer_export']) : '';
    if($answer_export == 'csv') {
        $site_answer_table = new Site_Answer_List_Table();

        $site_answer_table->export_csv();
    }
}
add_action('admin_init', 'site_answer_list_page_admin_init');

/**
 * List page
 *
 * @since 1.1.1
 *
 */
function site_answer_render_customer_list_page()
{
    $action     = isset($_GET['action']) ? sanitize_text_field($_GET['action']) : '';
    $id         = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $page       = isset($_REQUEST['page']) ? sanitize_text_field($_REQUEST['page']) : '';

    $title      = ucwords(str_replace('-', ' ',$page));

    $list = site_activities_get_menus();
    foreach($list as $item) {
        if($item[2] == $page) {
            $title = $item[0];
            break;
        }
    }

    //Create an instance of our package class...
    $site_answer_table = new Site_Answer_List_Table();

    if ($id > 0 && $action == 'detail') :

        $item = $site_answer_table->get_item($id);
    ?>
        <h1><?php echo $title ?></h1>
    <?php
        site_answer_render_customer_detail($item);

    else :
        //Fetch, prepare, sort, and filter our data...
        $site_answer_table->prepare_items();
    ?>
        <h1><?php echo $title ?></h1>
        <?php add_thickbox(); ?>

        <div class="wrap-list-table">

            <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
            <form id="answers-filter" method="get">
                <!-- For plugins, we also need to ensure that the form posts back to our current page -->
                <input type="hidden" name="page" value="<?php esc_attr_e($page); ?>" />
                <input type="hidden" name="tab" value="list" />
                <!-- Now we can render the completed list table -->
                <?php $site_answer_table->search_box('Search', 'name'); ?>
                <?php $site_answer_table->display() ?>
            </form>
        </div>
    <?php
    endif;
}

/**
 * Detail form
 *
 * @since 1.1.2
 *
 * @param object $item 
 */
function site_answer_render_customer_detail($item)
{
    $page   = isset($_REQUEST['page']) ? sanitize_text_field($_REQUEST['page']) : '';
    $uri    = explode('?', $_SERVER['REQUEST_URI']);

    $info = array(
        'name'      => '',
        'email'     => '',
        // 'phone_country' => '',
        'phone'     => '',
        'address'   => '',
        'gender'    => '',
        'city'      => '',
        'age'       => '',
    );

    ?>
    <div class="site_answer_detail">
        <table class="form-table" role="presentation">
            <?php
                foreach ($info as $key => $label) :
                    if ($label == '') {
                        $label = ucwords(str_replace('_', ' ', $key));
                    }
            ?>
                <tr>
                    <th scope="row"><label><?php echo esc_attr($label) ?></label></th>
                    <td><?php esc_attr_e(isset($item[$key]) ? $item[$key] : '') ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <th scope="row"><label><?php echo get_the_title($item['survey_id']) ?></label></th>
                <td>
                    <?php echo nl2br($item['answers']) ?>
                </td>
            </tr>
            <tr>
                <th> </th>
                <td>
                    <a class="button button-secondary" href="<?php echo esc_url(add_query_arg(['page' => $page], $uri[0])); ?>"><?php _e('Back', 'site'); ?></a>
                </td>
            </tr>
        </table>
        <?php // site_answer_render_winner_form($item) ?>
    </div>
<?php
}

function site_answer_render_winner_form($item)
{
    $survey_ids = site_admin_setting_get_values('survey_brand_id');

    if(!in_array($item['survey_id'], $survey_ids)) return;
    
    ?>
    <h3><?php _e('Winner Form'); ?></h3>
    <form method="post" action="" target="_blank">
        <?php wp_nonce_field('winnonce', 'winnonce') ?>
        <input value="<?php esc_attr_e($item['user_id']) ?>" name="user_id" type="hidden" />
        <table class="form-table" role="presentation">
            <tr class="row">
                <th scope="row"><label><?php _e('Fullname', 'site') ?></label></th>
                <td>
                    <input value="<?php esc_attr_e($item['name']) ?>" name="post_title" type="text" class="large-text" required />
                </td>
            </tr>
            <tr class="row">
                <th scope="row"><label><?php _e('Answer', 'site') ?></label></th>
                <td>
                    <textarea name="meta_description" rows="5" class="large-text code" required><?php esc_html_e($item['answers']) ?></textarea>
                </td>
            </tr>
            <tr>
                <th> </th>
                <td>
                    <input type="submit" class="button button-primary" value="<?php _e('Add New'); ?>" />
                </td>
            </tr>
        </table>
    </form>
    <?php
}

function site_answer_submit_winner_form()
{
    if(empty($_POST['winnonce'])) return;

    $nonce = sanitize_text_field($_POST['winnonce']);

    // Verify that the nonce is valid.
    if (!wp_verify_nonce($nonce, 'winnonce')) {
        return ;
    }


}
add_action('admin_init', 'site_answer_submit_winner_form');