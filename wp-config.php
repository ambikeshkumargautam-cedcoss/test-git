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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '4NBCeV15CUiQKrt0mOfQaqGdwTRce6Zp1W5464cKuAGe1mpVmuzPJBd70Zc8GanSeO6qQZBWL6VS9uCr5nSHxw==');
define('SECURE_AUTH_KEY',  'Rby6ytUcAej2JirxEdOqCz36g874D3OxtWLw8RVcWAG75Jqetod6kS8JKLmExEcHmo9AtAaDkxbV1vSAVrb+tQ==');
define('LOGGED_IN_KEY',    '/5CzylsZasQ1/kHd4g0SmE6HcsVFuTa0Y8lf0jVdBOmy6eHOg0xA3jJYrWbrY7rqQ2MUyVVhsWUvUziYGkNHKg==');
define('NONCE_KEY',        'EiaaVm5ksRyS3+8LSvwojd9jJBAs8jo++THiBNYbA8h6OpzlIwrbi3V7aMdWJSGAgumHMgVGTCtGJ0lGWp/Ihw==');
define('AUTH_SALT',        'NbnyP8SuxNtNezv3/JdWCsGwJRp5zm3wKCH6bRh4HGcPjYiX9xnjG+QgHgWeZ6Z8CWMh6dHMhgXkxg3AcOYO+Q==');
define('SECURE_AUTH_SALT', 'P1FeReigI1TasHW4/Xu4NpZcbnlYy1r54LV9Gx8RtfBenabv0TVEN4zxM3fXwFulpapc21+BUC5jvHxj538rcA==');
define('LOGGED_IN_SALT',   '3TWW4a5QPxG8kv5FFr1B52TdT4x0B7MC/tywFN55TaF9XoJG7gdRbGkqJtymRUJZFxbBOP3u8pEBDnGeQhWZrw==');
define('NONCE_SALT',       'sGopaF7ESa9Xzsj5tuGqWDHwiIHdOhr2PtN7/9FmAPQk9U+4BycqvaRAYG0vtQhQn9Lzz5fDGt+SUEaJr97UfA==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
