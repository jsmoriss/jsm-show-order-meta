<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2012-2024 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'JsmSomConfig' ) ) {

	class JsmSomConfig {

		public static $cf = array(
			'plugin' => array(
				'jsmsom' => array(			// Plugin acronym.
					'version'     => '4.6.0',	// Plugin version.
					'slug'        => 'jsm-show-order-meta',
					'base'        => 'jsm-show-order-meta/jsm-show-order-meta.php',
					'text_domain' => 'jsm-show-order-meta',
					'domain_path' => '/languages',
					'admin_l10n'  => 'jsmsomAdminPageL10n',
				),
			),
		);

		public static function get_version( $add_slug = false ) {

			$info =& self::$cf[ 'plugin' ][ 'jsmsom' ];

			return $add_slug ? $info[ 'slug' ] . '-' . $info[ 'version' ] : $info[ 'version' ];
		}

		public static function get_config() {

			return self::$cf;
		}

		public static function set_constants( $plugin_file ) {

			if ( defined( 'JSMSOM_VERSION' ) ) {	// Define constants only once.

				return;
			}

			$info =& self::$cf[ 'plugin' ][ 'jsmsom' ];

			$nonce_key = defined( 'NONCE_KEY' ) ? NONCE_KEY : '';

			/*
			 * Define fixed constants.
			 */
			define( 'JSMSOM_FILEPATH', $plugin_file );
			define( 'JSMSOM_NONCE_NAME', md5( $nonce_key . var_export( $info, $return = true ) ) );
			define( 'JSMSOM_PLUGINBASE', $info[ 'base' ] );	// Example: jsm-show-order-meta/jsm-show-order-meta.php.
			define( 'JSMSOM_PLUGINDIR', trailingslashit( realpath( dirname( $plugin_file ) ) ) );
			define( 'JSMSOM_PLUGINSLUG', $info[ 'slug' ] );	// Example: jsm-show-order-meta.
			define( 'JSMSOM_URLPATH', trailingslashit( plugins_url( '', $plugin_file ) ) );
			define( 'JSMSOM_VERSION', $info[ 'version' ] );
		}

		/*
		 * Load all essential library files.
		 *
		 * Avoid calling is_admin() here as it can be unreliable this early in the load process - some plugins that operate
		 * outside of the standard WordPress load process do not define WP_ADMIN as they should (which is required by
		 * is_admin() this early in the WordPress load process).
		 */
		public static function require_libs( $plugin_file ) {

			require_once JSMSOM_PLUGINDIR . 'lib/com/util.php';
			require_once JSMSOM_PLUGINDIR . 'lib/com/util-metabox.php';
			require_once JSMSOM_PLUGINDIR . 'lib/com/util-wp.php';
			require_once JSMSOM_PLUGINDIR . 'lib/order.php';
			require_once JSMSOM_PLUGINDIR . 'lib/script.php';

			add_filter( 'jsmsom_load_lib', array( __CLASS__, 'load_lib' ), 10, 3 );
		}

		public static function load_lib( $success = false, $filespec = '', $classname = '' ) {

			if ( false !== $success ) {

				return $success;
			}

			if ( ! empty( $classname ) ) {

				if ( class_exists( $classname ) ) {

					return $classname;
				}
			}

			if ( ! empty( $filespec ) ) {

				$file_path = JSMSOM_PLUGINDIR . 'lib/' . $filespec . '.php';

				if ( file_exists( $file_path ) ) {

					require_once $file_path;

					if ( empty( $classname ) ) {

						return SucomUtil::sanitize_classname( 'jsmsom' . $filespec, $allow_underscore = false );
					}

					return $classname;
				}
			}

			return $success;
		}
	}
}
