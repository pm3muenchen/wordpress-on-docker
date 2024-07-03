<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 * You can get Mysql setttings from your web host.
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
define('AUTH_KEY',         'yKa18MJ8OBotfyNP19zRS2nqXZ9X6nMWT-YjXFLub-c=');
define('SECURE_AUTH_KEY',  'dCIKO8bZOrwO6r6F106HGQVW4UC88JePXn7W4GRNyqg=');
define('LOGGED_IN_KEY',    'QZ2Lyohyeq1LMmUlrD3NkXUqMjXCo-oklgGTG7KJpTA=');
define('NONCE_KEY',        '4BHACqRW7lt7L5i_FA3Hk3kiDk0-d_KmIQ6rCoMqP1M=');
define('AUTH_SALT',        'pHBlrvhs7M5gjgjTw8pIxUKNIb680kkK7XiZt4ijJzE=');
define('SECURE_AUTH_SALT', 'MO7_nZwh26CxKr-Go-geYEN_0k5udlccM723LspRafk=');
define('LOGGED_IN_SALT',   'y6Zkne64KgbekDCV1u-0l849uZbZm5eeZJROMzueH7s=');
define('NONCE_SALT',       'aBtSFARatApniogTEvlAGY7zbShUwDLonqAnzZFst-M=');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'vorstand_';

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
define('DISALLOW_FILE_EDIT', true);

/**
 * API for One.com wordpress themes and plugins
 */
define('ONECOM_WP_ADDONS_API', 'https://wpapi.one.com');


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
