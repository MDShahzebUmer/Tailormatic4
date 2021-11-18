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
define( 'WP_SITEURL', 'http://demo.duniyatailor.com/public/blog/' );
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'becoming_Tailormatic_support');

/** MySQL database username */
// define('DB_USER', 'root');
define('DB_USER', 'becoming_Tailormatic_support');


/** MySQL database password */
define('DB_PASSWORD', 'tailormatic_');

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
define('AUTH_KEY',         'HMR0qJO<8L2j/AB&t=Y1Hk)Q>0%-&,rK=~Rb^BA:UrYxn^Q^!dVXlj3pRT%A;!1-');
define('SECURE_AUTH_KEY',  '](}I&r:U~*|3&Y[khECHbpA#TIW|hmj!^3LRY3gO<|hXb>R}T_rkK<]NB.dEp_0>');
define('LOGGED_IN_KEY',    '>5K<o+omH/pdz$4OIr!_JnoZoM5 S,@I?{e6IF~8tn=l!9TKni3ez.mhFtru&$ <');
define('NONCE_KEY',        '8y7H&L7([`jQI/?P9iOKOT$BV7W?%(xah6z&;ZXW1G)$jN1$F.t9MkiHcN`MpAY`');
define('AUTH_SALT',        ')_8Roz@kQs~QI0}%}7UOv:TcKsfuh0&(lkj: (wOc%,yHHthEbZetA6oyk8oIYKB');
define('SECURE_AUTH_SALT', '3;*-I`c-J|Hn2<I9IrMJz17ASC8_>9gDmn*+3-3`FJ}A!4)D1i%tEO*<TsW^cmE<');
define('LOGGED_IN_SALT',   'LzwZfg-~v&cCC9alR^ck01?Yt,VF+0Hj3eGq<oN>e|kn-)HXw=[H8^rUDqg6su1o');
define('NONCE_SALT',       'XRLLg7 k9QC^38Ho+mWO4(d@}h FS!E5?zV::xe~d8 cLD%Cs<?Sx%+BHBmqlZ#2');

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
