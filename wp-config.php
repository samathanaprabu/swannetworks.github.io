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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'swannetworks_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'vN:g~(FfroL;lBJ(JuD -Y8`DUv^uCyZJ ,WW3,0267 WE|.=@88w.<?wgBe!=LU' );
define( 'SECURE_AUTH_KEY',  'p_NMhSMnCGI6p4E&M1TDbvv+Ys*DJc2Ri?E,i,!)37MrQPVPA1]t2-artz4;M~o<' );
define( 'LOGGED_IN_KEY',    'Ys^./9b|xNCXU~LkyT-jGvEw/D@*.1jDhSGs;UVUmlQ8&*fxTN}J;}iCl}gBzm.&' );
define( 'NONCE_KEY',        'm]^~R`}m=,Y@q0]D1ET{v.<u(/Nk$t9Kxr}s<J%rOV)m#$nGG>ozFG0:SI@SZ}i(' );
define( 'AUTH_SALT',        '$%IBKa %]h$+[tT~|S.fQ]u?_S|ipE`0ggs0]B%7X`FlTrGb@&WWL#k96ef!c%;n' );
define( 'SECURE_AUTH_SALT', 'F.Gd ElX61{eA>knHFCt&R zNixCYH+/@7Vk80@ x#,mo98L_ORftV]RxgoG0uHV' );
define( 'LOGGED_IN_SALT',   'v|phX,I{qiG*SrYQ,NY;w V<D`{{<}G!{[BcaJxLN5VS+3%TG#oHs {[Pd.z$Lbp' );
define( 'NONCE_SALT',       'M_]V!Vg]I1RX$lV3UfmOa:n~k4)_6YH3jPV~*2@_jqm?R}cg?]nuI9=`INu]i<8I' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
