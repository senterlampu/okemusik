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
define('DB_NAME', 'palomas1_wp730');

/** MySQL database username */
define('DB_USER', 'palomas1_wp730');

/** MySQL database password */
define('DB_PASSWORD', 'kph..14p1S');

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
define('AUTH_KEY',         'qzszp8ryulaymlc05mn3wcjyoox4ooabulncjhexmgoxe9rmit42om54ojcrts5o');
define('SECURE_AUTH_KEY',  'adi9q638ekq5bwfspgguh5mtxyijnlmtb28lwzgu9d3iekkd13kwiwqnzmwbvhzu');
define('LOGGED_IN_KEY',    'klqsgdkwxpybrb2wjxtfpckjayqb2ion6dumgxxjsyt70r3i6qbvmuzwlvoez76s');
define('NONCE_KEY',        'lfbiqbjrelcbye77f4tuzuzchhuu4tsihtgoseqsstydrb0we0aokq7mslmv0kx2');
define('AUTH_SALT',        'g1inxwf5dedixg3apfdglsswoumey8ozihehdufbhklnjxq86cforw9ep3dfsdeh');
define('SECURE_AUTH_SALT', 'lqky6iopms1zn56d19f3jt2jwwf2pngzxtsuouapxfvh7vbapbcbul5dglg7nvyk');
define('LOGGED_IN_SALT',   'u938ormhkzykmruhvs6qx2ceaibkoksousva2zud2tlfpwfefixghe3p5yd6jkgt');
define('NONCE_SALT',       'uk94ujc8d4izwghgypeazqis1bwezc5qf9whvtqul0tyfsqgwoktayudtqmye5u7');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpiy_';

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
