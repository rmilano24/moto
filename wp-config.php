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
define('DB_NAME', 'moto');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'L*1j-`n|GL2?ybW-,[wnKn)=a>)V>KB-mHV2/rhbiMh8h_*|maaN3q;u UyB};0;');
define('SECURE_AUTH_KEY',  '$e@AGB+&FM$UaKm12k!!eNFotq81[?YttbW!>F$]N!UQ?=rw^`R`F-z&;|Z5K#1]');
define('LOGGED_IN_KEY',    'C$$=lC/c/a4Co0r!J0V-.^g>)%75)$du41@3gPBV+[<l@ai(E.QlR|b2HoI=Sw|b');
define('NONCE_KEY',        '`a4iajg#&/OEM@swux%7vyc}J ,ID6p0R^eQ<+=xUr%O|Hb~:bXJfkgII=tc<b3(');
define('AUTH_SALT',        'PeI~@*D>-HW-+B*wW41z]9]@mDvv>iuSZ?T#Fp]nQ9JY~/s|}-u-:Q:;e8v|Dq<P');
define('SECURE_AUTH_SALT', 'c%drk2C+G>(tf?]s|A.P| tZh[</CicMHba`,z](<Z&Snl#8lh~r] ETcWcZKOHJ');
define('LOGGED_IN_SALT',   '0; -# gi/*n&r&~K>foE-t5. .?$/D2n3m-8$}y_4/F$ +-AWR8Ijo9jm`C5g<i#');
define('NONCE_SALT',       'TIA%wR(t[FA#40afr1QnskMnj*|+c_9>uWGKv@%+;>`9_{SM_d+2l1,#O-od`i%D');

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
