<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ecommerce_loja_virtual' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '*1rD81^,F{jp}J7[0_;xEPH!U`1RQLGp3f;HX4rn6z^J{B:0*qpwty6b3}01NS!#' );
define( 'SECURE_AUTH_KEY',  'cg>ya7F7eIM)#]fSrt`HNnb]WS8}[oHII#iK8t1euv$TymPf3ahGjgKz=*&`{w1k' );
define( 'LOGGED_IN_KEY',    '!r{I*VR8|I=-@axSfWP=HC+:{;hC;!}=7/{bnnw0M5PwA#zcW69Rx@=r>smO0:-e' );
define( 'NONCE_KEY',        'bZa7Vjye=`xaby`Oz4Pg9cqkP9Fb>vkGV8q$CriS>94zqOL_`hZEgxCX;czENY}&' );
define( 'AUTH_SALT',        'FH@X^eW)6tN#=O}l|w.w:;@XbKv5Hc<{[{|pxmv@RMF%!j$=/)=n7u*KE7tvS;U3' );
define( 'SECURE_AUTH_SALT', '3<]B|7MyD|=7knzvF-EV&2)RU33Zu=e-esi*n81(X6.5,5f$04+),Am[Zs1|q;V)' );
define( 'LOGGED_IN_SALT',   'F1Fd2oqKY,zj,+o~`?a1yBJ%V[CF/VXMEGl5LF5rud!7ry!?t`bCOXlAmDV`$=4P' );
define( 'NONCE_SALT',       '=ti%jgR9{-^]PLv <kaPUhR,4Bm&R;D&u0*<9rPwq)]D+W/jkH7)j<T;=-d5#*(g' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'bs_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
