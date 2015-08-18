<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'schuessler');

/** MySQL database username */
define('DB_USER', 'admin');

/** MySQL database password */
define('DB_PASSWORD', 'GlossyG3t');

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
define('AUTH_KEY',         'W!kd@3x;:m@TFw#|}eA-~AN%T&2@2n4,9A;bjui#fF*:(Odj$bVb:b[3+0@Xwhs_');
define('SECURE_AUTH_KEY',  '$cJEbRT`Jtz`;2M$0Ie7Wh>}#o[EPn|u[+O4an=Wz:&uEs{M9L2y6x**2{+vW^A^');
define('LOGGED_IN_KEY',    'L|pU=xz}3Xg)z Q-{TA+xs/r-=Il3C;OC0_4bOqP>PS!`jU|817.AcAS+Qgj|Ui=');
define('NONCE_KEY',        'ENjn@PYfMyH=a7Y!LR@3^]jI_gY|[9lv:OT|T#)cv.Kz!m?,BP[h`z]M>+%5F0gI');
define('AUTH_SALT',        ';XYu/B+CLY~+y-uESS-e?xiUZ^#=r;Fba%exK#~w)))+m@P||&<Tj%TFgzvw,7zO');
define('SECURE_AUTH_SALT', 'sZ5X&;$D!yZK6>mTL7WAK,W ]]]-hn>&T-}Qh/BC9))U7u?`/w)8qBUP$8{n1OiS');
define('LOGGED_IN_SALT',   '^cuk$e |GPr11+=]#xoTy6=UV]~i1`uq?A[z3m]@#C]^z!/)+Rs :nTDU~GAr/-|');
define('NONCE_SALT',       'XF*l150+Po<gZj}C-u[o}^.+Vz=`A~-pk3Kj#NTG8/y*b=$P7#_vUZtAd&;9#q6s');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpshuessler_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
