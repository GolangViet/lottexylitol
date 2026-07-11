<?php
defined('ABSPATH') or die();

/**
 * wp-includes/user.php
 * 
 * Filters 
 */

/**
 * Filters the contents of the email sent when the user's password is changed.
 *
 * @since 4.3.0
 *
 * @param array $pass_change_email {
 *     Used to build wp_mail().
 *
 *     @type string $to      The intended recipients. Add emails in a comma separated string.
 *     @type string $subject The subject of the email.
 *     @type string $message The content of the email.
 *         The following strings have a special meaning and will get replaced dynamically:
 *         - ###USERNAME###    The current user's username.
 *         - ###ADMIN_EMAIL### The admin email in case this was unexpected.
 *         - ###EMAIL###       The user's email address.
 *         - ###SITENAME###    The name of the site.
 *         - ###SITEURL###     The URL to the site.
 *     @type string $headers Headers. Add headers in a newline (\r\n) separated string.
 * }
 * @param array $user     The original user array.
 * @param array $userdata The updated user array.
 */
function site_user_password_change_email($pass_change_email, $user, $userdata)
{
    /* translators: Do not translate USERNAME, ADMIN_EMAIL, EMAIL, SITENAME, SITEURL: those are placeholders. */
    $pass_change_text = __(
        'Hi ###USERNAME###,

    This notice confirms that your password was changed on ###SITENAME###.

    If you did not change your password, please contact the Site Administrator at
    ###ADMIN_EMAIL###

    This email has been sent to ###EMAIL###

    Regards,
    All at ###SITENAME###
    ###SITEURL###'
    );

    $pass_change_email = array(
        'to'      => $user['user_email'],
        /* translators: Password change notification email subject. %s: Site title. */
        'subject' => __( '[%s] Password Changed' ),
        'message' => $pass_change_text,
        'headers' => '',
    );

    return $pass_change_email;
}
// add_filter('password_change_email', 'site_user_password_change_email', 10, 3);
add_filter('send_password_change_email', '__return_false');

/**
 * Filters the contents of the email sent when the user's email is changed.
 *
 * @since 4.3.0
 *
 * @param array $email_change_email {
 *     Used to build wp_mail().
 *
 *     @type string $to      The intended recipients.
 *     @type string $subject The subject of the email.
 *     @type string $message The content of the email.
 *         The following strings have a special meaning and will get replaced dynamically:
 *         - ###USERNAME###    The current user's username.
 *         - ###ADMIN_EMAIL### The admin email in case this was unexpected.
 *         - ###NEW_EMAIL###   The new email address.
 *         - ###EMAIL###       The old email address.
 *         - ###SITENAME###    The name of the site.
 *         - ###SITEURL###     The URL to the site.
 *     @type string $headers Headers.
 * }
 * @param array $user     The original user array.
 * @param array $userdata The updated user array.
 */
function site_user_email_change_email($email_change_email, $user, $userdata)
{
    /* translators: Do not translate USERNAME, ADMIN_EMAIL, NEW_EMAIL, EMAIL, SITENAME, SITEURL: those are placeholders. */
    $email_change_text = __(
        'Hi ###USERNAME###,

    This notice confirms that your email address on ###SITENAME### was changed to ###NEW_EMAIL###.

    If you did not change your email, please contact the Site Administrator at
    ###ADMIN_EMAIL###

    This email has been sent to ###EMAIL###

    Regards,
    All at ###SITENAME###
    ###SITEURL###'
    );

    $email_change_email = array(
        'to'      => $user['user_email'],
        /* translators: Email change notification email subject. %s: Site title. */
        'subject' => __( '[%s] Email Changed' ),
        'message' => $email_change_text,
        'headers' => '',
    );

    return $email_change_email;
}
// add_filter('email_change_email', 'site_user_password_change_email', 10, 3);
add_filter('send_email_change_email', '__return_false');
