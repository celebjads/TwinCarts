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
define('DB_NAME', 'supportcart');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'TUl*i{:-z2#-9qr&iaFjfE6Z~yiIxS;eDV8F~42VhcJF!^ntpo>Y~G&p~T^z1suR');
define('SECURE_AUTH_KEY',  '7zw+S`;0S(JSr)5$jQ.C:%-uV*)6r]R [-JY,Y(fAF0igYa^fP]`8CVStK4z7vyC');
define('LOGGED_IN_KEY',    '_8ZysyKz)~b{-9iQ/*G5[6pW;v;W=nNcCJFjnP)<GY=3.Tl2aN?0,62S.2UGUpt4');
define('NONCE_KEY',        '%A]L^E)*Gf|2U`MQlm+hB9$_v0_Kl^l6WnoMzSj/).+?y>?sX0&:HV!$s%#;agDf');
define('AUTH_SALT',        'x6F5H1Tg-f!qw&|bL*8B=R oO)Sv:c<iPJC(HiYu>fb^9[A`)7u7*0[r:kMCjw9u');
define('SECURE_AUTH_SALT', '?H5!P.uwU9(_anhxlN#sy$}JM)dLS1Q@dPV/^,4uo(>#MaCNBzDbd&,F)nka:/4%');
define('LOGGED_IN_SALT',   'NpWAK;!(2_{;3NuU}x_oOyIH;,Zs/sfVgv,|2_H98/T8C|3_t64X6 ~{cDY7Q?0A');
define('NONCE_SALT',       'R1R$g>ahld?Y`NLMv.@=_];-^Ebu7RXD|Q1|z ~.R|*Z%V(l#UK+qW-9v-1/,uux');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
