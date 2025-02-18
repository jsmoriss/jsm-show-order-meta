<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2012-2025 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! defined( 'JSMSOM_PLUGINDIR' ) ) {

	die( 'Do. Or do not. There is no try.' );
}

if ( ! class_exists( 'JsmSomScript' ) ) {

	class JsmSomScript {

		public function __construct() {

			$doing_ajax = SucomUtilWP::doing_ajax();

			if ( ! $doing_ajax ) {

				if ( is_admin() ) {

					add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
				}
			}
		}

		public function admin_enqueue_scripts( $hook_name ) {

			$this->admin_register_page_scripts( $hook_name );
		}

		public function admin_register_page_scripts( $hook_name ) {

			$cf = JsmSomConfig::get_config();

			$admin_l10n = $cf[ 'plugin' ][ 'jsmsom' ][ 'admin_l10n' ];

			/*
			 * The version number should match the version in js/com/jquery-admin-page.js.
			 */
			wp_register_script( 'sucom-admin-page', JSMSOM_URLPATH . 'js/com/jquery-admin-page.min.js',
				$deps = array( 'jquery' ), '20240810', $in_footer = true );

			wp_localize_script( 'sucom-admin-page', $admin_l10n, $this->get_admin_page_script_data() );

			wp_enqueue_script( 'sucom-admin-page' );
		}

		public function get_admin_page_script_data() {

			return array(
				'_ajax_nonce'   => wp_create_nonce( JSMSOM_NONCE_NAME ),
				'_ajax_actions' => array(
					'delete_jsmsom_meta' => 'delete_jsmsom_meta',
				),
				'_del_failed_transl' => __( 'Unable to delete meta key \'{1}\' for order ID {0}.', 'jsm-show-order-meta' ),
			);
		}
	}
}
