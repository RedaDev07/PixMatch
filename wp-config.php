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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'formatiosvpix' );


/** Database username */
define( 'DB_USER', 'formatiosvpix' );


/** Database password */
define( 'DB_PASSWORD', 'Xd4s5e6F9ZqdyS63zeQq9Pd' );


/** Database hostname */
define( 'DB_HOST', 'formatiosvpix.mysql.db' );


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
define( 'AUTH_KEY',         '>UDB(}(Rx#4TBJ(W@g]h);%%_#PQ#`+#z_,ijBk*9DM>5+#Ak.G~.NK_z^ DsD2E' );

define( 'SECURE_AUTH_KEY',  ',tjy=tL&>)s<5s<Z(KTJdh/bHaRAa%jHRRiG?1w[_RvJd~({M!sbx+;(GAn&Kr$o' );

define( 'LOGGED_IN_KEY',    'k-><oAR+XATo*DLP7&MW{9#h:=!QJgu}x,~:~%lE%7{/5V) (IoH)`kMjS-VEg4s' );

define( 'NONCE_KEY',        'YW?9(@B.G3{@<5=0eL|sX_z_#s$O=-M={B3UOSnrlQJ`b#cZdwT^(&P1trO79(7]' );

define( 'AUTH_SALT',        ')IJ.%L6eAV|pAY:DAu.(HzAoew 95pEE.hJ#gBYK&H3_biZp(rg`]k]7VWx+[DY9' );

define( 'SECURE_AUTH_SALT', 'n6LS0w48t:b>K,+;@,p2 }n^@nw/4?bHkBXHA0c|>G/,~6Nuw$/}4Z#8/P#j_hvg' );

define( 'LOGGED_IN_SALT',   'Uh _^A[v6pdhX}$E.IDV9wBF~1F<bR3<iJ/<vHd?K-$__b~.y<wJ&Mv %`.C;jxA' );

define( 'NONCE_SALT',       'KYSOa9@Pv)PORGCr=W1~`c#uEnL}[$x_3]8+^;]Pz=u2g-Z&,JabATUkPr#JGf2t' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'pixm_';


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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);
/* Add any custom values between this line and the "stop editing" line. */

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
