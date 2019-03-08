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
define('DB_NAME', 'wordpress');

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
define('AUTH_KEY',         '-V@:G4b8xdV%Xr^x`)I=#Pd6-qK4YI_^dTLBG6mQpQIamV5*|Vx;}i1:P3YlpQ+V');
define('SECURE_AUTH_KEY',  'vJIsBI^OHSoAU369bLOB]^cRuAsy1tDb$Pqt1)h?-9J6%Gj`H|]t7Mw@Q0k,j3;]');
define('LOGGED_IN_KEY',    '#2Q(v<Jj6ewU(Gk>sTW8]kA[J/3?=*]*G O%tw3$_-gSvI5+:px=Kts7XgJ>EX.5');
define('NONCE_KEY',        'c!|q8mLfVtk0wN%c<aE3ektT~_,`J=TRYS~g?=OT9{&hFvFee58*O?Rt RpZO-m&');
define('AUTH_SALT',        '8i_ML4y5V^3c| GFLgx^jWQF#+s_/yP,,G8 TsP>vA-GwoO[SIdRsh8{&JY`]Ip%');
define('SECURE_AUTH_SALT', '$sdUhy$N74;+}a~lJvO?lws=~U{.B&+RC}B%>do}`7381YLHL1AaD:0@$guAk^F>');
define('LOGGED_IN_SALT',   'reFz7lNZ{VkQ0.sg^,*a+@|2u#yM,ub&SBtPO.m#qpxY2H)=!;[qc!1h3Qv:xY>s');
define('NONCE_SALT',       '?ht`e/(-R;vi6ZSg$U~akQ8$l!&Fg@_$(mPNUpfSl/WeKqyRC:L`^P;T0i^$Axd.');

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
