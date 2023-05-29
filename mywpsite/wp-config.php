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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mywpdb' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '{Ohk8=Ppvoz%XY(XXP67+_ .6 / oV,R(w4gO%Fn3pG,SU/0ulzB=~30lE=O_C7K' );
define( 'SECURE_AUTH_KEY',  '-bgM_O:9?3Df_F^LEim?NygYwAWJe7MA?i*<]yg:N.9#P-n)D}Z;v,/Pwq7l~2zM' );
define( 'LOGGED_IN_KEY',    'lW~x7OJiR=uTHP*DO9VZ/{4qC9`ohat^Z?{r$1{QIm~HV6)G^z+<f)TV;-i,)-==' );
define( 'NONCE_KEY',        ',!m{L2roO8I<iCbEoC21YKh!LfP^q^m<oyY)XMzE*d,fSFbF]L(-Ud~_&.T1&=l#' );
define( 'AUTH_SALT',        'v3f<^Q$gjp(j-Oi_~*en<J+Xy.SU?THy$Ig!L!szUF>9+=d8I|rjFP`5_w^=xMJ[' );
define( 'SECURE_AUTH_SALT', 'ggIhj*SZ#:>[1q#NeXDIzh2)Hx83 w>:j_.Z<|nH]Q%KX&K{Td-%7=Fz:WBU5?_x' );
define( 'LOGGED_IN_SALT',   '& b1Y&gq7.qGng%ov9X0A{ )|q0.W>_/]Hc_ C>w=A8gMbmey#4vKx7Iieiy/z(K' );
define( 'NONCE_SALT',       '{JrvBJU5]>CvL?zc-LCcY##$zfoMQp;E_Z$/(Aeaz#Ky<QjF;Gk6P$oy@8d>xUD{' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
