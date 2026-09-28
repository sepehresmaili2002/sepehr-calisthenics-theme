<?php
/**
 * Long browser-cache lifetimes for static files (fonts, images, versioned CSS/JS),
 * written to .htaccess between "Sepehr Performance" markers — the standard
 * WordPress way (insert_with_markers). Removed again when the plugin is deactivated.
 *
 * @package sepehr-seo-geo
 */

defined( 'ABSPATH' ) || exit;

define( 'SEPEHR_HTACCESS_RULES_VERSION', '1' );

/**
 * @return string[]
 */
function sepehr_htaccess_rules() {
	return array(
		'<IfModule mod_expires.c>',
		'ExpiresActive On',
		'ExpiresByType font/woff2 "access plus 1 year"',
		'ExpiresByType application/font-woff2 "access plus 1 year"',
		'ExpiresByType image/webp "access plus 1 year"',
		'ExpiresByType image/avif "access plus 1 year"',
		'ExpiresByType image/jpeg "access plus 1 year"',
		'ExpiresByType image/png "access plus 1 year"',
		'ExpiresByType image/gif "access plus 1 year"',
		'ExpiresByType image/svg+xml "access plus 1 year"',
		'ExpiresByType image/x-icon "access plus 1 year"',
		'ExpiresByType text/css "access plus 1 month"',
		'ExpiresByType application/javascript "access plus 1 month"',
		'ExpiresByType text/javascript "access plus 1 month"',
		'</IfModule>',
		'<IfModule mod_headers.c>',
		'<FilesMatch "\.(woff2|webp|avif|jpe?g|png|gif|svg|ico)$">',
		'Header set Cache-Control "public, max-age=31536000, immutable"',
		'</FilesMatch>',
		'</IfModule>',
	);
}

/**
 * @param string[] $rules Empty array removes the block.
 * @return bool
 */
function sepehr_write_htaccess( array $rules ) {
	if ( ! function_exists( 'get_home_path' ) ) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
	}
	if ( ! function_exists( 'insert_with_markers' ) ) {
		require_once ABSPATH . 'wp-admin/includes/misc.php';
	}
	$file = get_home_path() . '.htaccess';
	if ( ! file_exists( $file ) || ! is_writable( $file ) ) {
		return false;
	}
	return (bool) insert_with_markers( $file, 'Sepehr Performance', $rules );
}

// Write (or refresh) the rules once per rules version, from an admin page load.
add_action( 'admin_init', function () {
	if ( get_option( 'sepehr_htaccess_rules_version' ) === SEPEHR_HTACCESS_RULES_VERSION || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( sepehr_write_htaccess( sepehr_htaccess_rules() ) ) {
		update_option( 'sepehr_htaccess_rules_version', SEPEHR_HTACCESS_RULES_VERSION, false );
	}
} );

register_deactivation_hook( dirname( __DIR__ ) . '/sepehr-seo-geo.php', function () {
	sepehr_write_htaccess( array() );
	delete_option( 'sepehr_htaccess_rules_version' );
} );
