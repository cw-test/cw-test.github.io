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
define( 'DB_NAME', 'supadu' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         '(H(cWR6`*.]VZ+0]yy#%QP:z_bHe>xnP! .vt|@hD (lv.KBygN~)1$@CZ0FhSAZ' );
define( 'SECURE_AUTH_KEY',  '*J@:0]{!4^Ov1es?c& ZVJ ,yAB_`kq,[%lAfj[ta)SHsie`G]V7xut3&Ip1N+{%' );
define( 'LOGGED_IN_KEY',    '#kz8]eF)T(2l>jXx0Hp/Z fi;F#nNnTFUf|zyq;uUUJ!R+m?j;Kyb)JoCbnB#6-s' );
define( 'NONCE_KEY',        'I&fJ>5 sIU4+T~dA{s.M8UU:H^,4T&PiBH>HCVYJa8%a,j6lNW8cV/e0n+j5*mj4' );
define( 'AUTH_SALT',        'g;35?!fkF/kNPQ)m)=s__Wudue)=fsI[Bm[!a/xhGzo}bxkl _^PT~p1D+-Fnkwo' );
define( 'SECURE_AUTH_SALT', '^V|/2Ox2e4$i`jr MmH8g-3kYMz{jK9IW%W?]T=xYlQ}0q%!Kqh8c&2fULsb(oHz' );
define( 'LOGGED_IN_SALT',   '-*kh1LIKyQtCN*W9)=1{B_e Cj5+^nYcStESdyV`aiukuf+-*BDTw>)<zZ{PV!]W' );
define( 'NONCE_SALT',       'Wp3Ba*5a8tAZu=LS`oDeQ^[ncR>Z(I4W05n;pM:))a9o*JD BXU1Za*O%B[$D5zl' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
