<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */
// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', "lottexylitolcom_db24" );

/** Database username */
define( 'DB_USER', "lottexylitolcom_us24" );

/** Database password */
define( 'DB_PASSWORD', "Zf96UlAKND755OWLxL" );

/** Database hostname */
define( 'DB_HOST', "localhost" );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '3RAfT,TI_?EL2x58`2Fmb/7ZakP I<KiBdG5,uMo2uFgIsty/H*vS>E>1J?b.Z2j' );
define( 'SECURE_AUTH_KEY',  'j/Iu;[OJkyM_r5s<d|1!J+/s.>)*s=73%h{u{Vwx6@%zq/CPb`~%,P&~r;gV2nQ`' );
define( 'LOGGED_IN_KEY',    'f1<WFo|/YH8?*]%!zk]T!_,Y9/`PjjH<A=qbMG9R8laq$G4Hzx<[9w.L`n[Ad$wY' );
define( 'NONCE_KEY',        '0B!_+wb@a#Jc=~UUufv+g&8j~o;nITWr@Q-dHD<B^Br>r$T|: 8vGrz|OK_`>+qZ' );
define( 'AUTH_SALT',        '9*}.dNmuXQSA0Ev1y3;;]8odgb!9_[1!DQl}yBkr~TOa{)*u}w_JDK$@7UMyPv?`' );
define( 'SECURE_AUTH_SALT', '<S+DWt^F{mlRnK@KMApU)DPur)I&uKV4OLd`Qe%Rmb).)w8e$`BjYbt<F#LPC)5y' );
define( 'LOGGED_IN_SALT',   '^:NP^=gkyU;`XR0jj4~A^s`@.iJJNnOFsoX-BJP _f6VVAy?b[~%uZ9/)V4(*FDc' );
define( 'NONCE_SALT',       'vb!0tRNRCwAG``G~,qGP/{8kg8h6oXt8e3[V^H!vHwi.Wb^J~>g<o:-1[u-|DD^S' );

/**#@-*/
/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'lot_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
/* Add any custom values between this line and the "stop editing" line. */

define( 'WP_AUTO_UPDATE_CORE', false );
define( 'AUTOMATIC_UPDATER_DISABLED', true );


@ini_set( 'upload_max_size' , '20M' );
@ini_set( 'post_max_size', '20M');
@ini_set( 'max_execution_time', '300' );

/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname(__FILE__) . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
