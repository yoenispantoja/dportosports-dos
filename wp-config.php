<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u236685198_dportosports' );

/** Database username */
define( 'DB_USER', 'u236685198_dportosports' );

/** Database password */
define( 'DB_PASSWORD', 'Dporto2025*' );

/** Database hostname */
define( 'DB_HOST', '191.96.56.103:3306' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'dHA-$^<bCSA{T;)EnpZJYrHIZ9[1RO~q;rQ9DuV?]nm_A)&rh3GQ&YI)u!_0Txjk' );
define( 'SECURE_AUTH_KEY',   'Z7.lWVXfqKvWH%)Vn,Vfc8Jz|q .QKIMClt@J!b]/N9}DjAS@~z__j9.^$9E.!9$' );
define( 'LOGGED_IN_KEY',     '!fyB(w|Gl.t:7l#M>J2;R!q8GZ;SIu/q]p6`au/I l~tCU-~J|xY;@d&NG v5,v;' );
define( 'NONCE_KEY',         'P+P8zOII: Qp6OZ+i?oT=mOy4l5!DFt0<&]u!;6d>:>{t2yFH}Z`j6gB}k?E&rxO' );
define( 'AUTH_SALT',         'K+7<)H,)J79eYWiEeTM*mT0A[^1K@y8;_`Q}=S`6m22V41L 4+_ A=XNzS[w0dbY' );
define( 'SECURE_AUTH_SALT',  '}q0^z14|Eeg!D7VDB-L:gav:Qjos0amNq6korj6nBT0m&BcZ^<t,>}5%)_]#.6hw' );
define( 'LOGGED_IN_SALT',    '8cBIq38_WMce@-)6*H|;QQM5!mYy8[o(Vbz;51u5lKb6DPM?Lk-sq|9e$;C0vgie' );
define( 'NONCE_SALT',        '1AHB(Lwj`rJPz%bg=JUv2v:Gy@q- $Z`AkVacJIC]7h^uElWJ8XUra0Cud4;6-zp' );
define( 'WP_CACHE_KEY_SALT', 'x.3Wh$@7C[I;#io]S.J8$`sa%i6Yv~jI(&8BWF@Te@+1yOVbM?5:Eh~jT5g@{m(I' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
