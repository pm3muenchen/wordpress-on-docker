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
define('DB_NAME', 'pm3muenchen_de');

/** MySQL database username */
define('DB_USER', 'pm3muenchen_de');

/** MySQL database password */
define('DB_PASSWORD', 'Pw2cBzC8');

/** MySQL hostname */
define('DB_HOST', 'mariadb');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'SbBUgwRkoIddO8H2w1VeX5tw8X589piSkznPZI0Neaw=');
define('SECURE_AUTH_KEY',  'fCNpJm-QxCup0xlSLxOWBVdU9kpSuIZS5fwowsfzXbU=');
define('LOGGED_IN_KEY',    'CwxUGyEX73ivdCq_mxfuxUuXt2npHx9NOb4EO86C0XM=');
define('NONCE_KEY',        'znahtvrGtEAmlrX-QMt__a-R9We003LxWrpaA_h3AWU=');
define('AUTH_SALT',        '1CslpVlp1G-Y8o6Qjskt1pXghu7Vye1zsepyafqIsxg=');
define('SECURE_AUTH_SALT', '_dsNAdGP7At_FgTR5tuWxOJ_gkrXa-CwIdd3qTcQZAs=');
define('LOGGED_IN_SALT',   'eDNMxTAJsJS8Mh41_ExUG8OjVL3ff8HpgDhGFVzZ0KI=');
define('NONCE_SALT',       '647rdga0mweX5nkh6jfRCuq-Z-LSayAUAcajcSqF2Fw=');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'www_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'en_GB');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/** 
 * Prevent file editing from WP admin.
 * Just set to false if you want to edit templates and plugins from WP admin.  
 */
define('DISALLOW_FILE_EDIT', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
