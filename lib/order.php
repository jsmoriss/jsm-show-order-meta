<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2012-2024 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! defined( 'JSMSOM_PLUGINDIR' ) ) {

	die( 'Do. Or do not. There is no try.' );
}

if ( ! class_exists( 'JsmSomOrder' ) ) {

	class JsmSomOrder {

		public function __construct() {

			add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 1000, 2 );
			add_action( 'wp_ajax_delete_jsmsom_meta', array( $this, 'ajax_delete_meta' ) );
		}

		public function add_meta_boxes( $post_type, $obj ) {

			if ( 'woocommerce_page_wc-orders' !== $post_type ) {

				return;

			} elseif ( ! $order_id = $obj->get_id() ) {

				return;
			}

			$show_cap = apply_filters( 'jsmsom_show_metabox_capability', 'manage_options', $obj );
			$can_show = current_user_can( $show_cap, $order_id, $obj );

			if ( ! $can_show ) {

				return;
			}

			$metabox_id      = 'jsmsom';
			$metabox_title   = __( 'Order Metadata', 'jsm-show-post-meta' );
			$metabox_screen  = $post_type;
			$metabox_context = 'normal';
			$metabox_prio    = 'low';
			$callback_args   = array(	// Second argument passed to the callback function / method.
				'__block_editor_compatible_meta_box' => true,
			);

			add_meta_box( $metabox_id, $metabox_title, array( $this, 'show_metabox' ),
				$metabox_screen, $metabox_context, $metabox_prio, $callback_args );
		}

		public function show_metabox( WC_Order $obj ) {

			echo $this->get_metabox( $obj );	// Outputs a complete HTML metabox.
		}

		public function get_metabox( WC_Order $obj ) {

			if ( ! $order_id = $obj->get_id() ) {

				return;
			}

			$cf = JsmSomConfig::get_config();

			/*
			 * Create an associative array of WC_Meta_Data objects.
			 */
			$metadata = array();

			foreach ( wp_list_pluck( $obj->get_meta_data(), 'key' ) as $key ) {

				$metadata[ $key ] = $obj->get_meta( $key, $single = false );

				/*
				 * The array should be a single WC_Meta_Data object.
				 *
				 * if ( is_array( $metadata[ $key ] ) ) {	// Just in case.
				 *
				 * 	$num  = 0;
				 * 	$data = array();
				 *
				 * 	foreach ( $metadata[ $key ] as $wc_meta_data_obj ) {
				 *
				 * 		if ( $wc_meta_data_obj instanceof WC_Meta_Data ) {	// Just in case.
				 *
				 * 			$data[ $num ] = $wc_meta_data_obj->get_data();
				 *
				 * 			$num++;
				 * 		}
				 * 	}
				 *
				 * 	if ( ! empty( $data ) ) {
				 *
				 * 		$metadata[ $key ] = $data;
				 * 	}
				 *
				 * 	unset( $num, $data );
				 * }
				 */
			}

			$exclude_keys = array();
			$metabox_id   = 'jsmsom';
			$admin_l10n   = $cf[ 'plugin' ][ 'jsmsom' ][ 'admin_l10n' ];

			$titles = array(
				'key'   => __( 'Key', 'jsm-show-post-meta' ),
				'value' => __( 'Value', 'jsm-show-post-meta' ),
			);

			return SucomUtilMetabox::get_table_metadata( $metadata, $exclude_keys, $obj, $order_id, $metabox_id, $admin_l10n, $titles );
		}

		public function ajax_delete_meta() {

			$doing_ajax = SucomUtilWP::doing_ajax();

			if ( ! $doing_ajax ) return;

			check_ajax_referer( JSMSOM_NONCE_NAME, '_ajax_nonce', $die = true );

			if ( empty( $_POST[ 'obj_id' ] ) || empty( $_POST[ 'meta_key' ] ) ) die( -1 );

			$metabox_id   = 'jsmsom';
			$obj_id       = SucomUtil::sanitize_int( $_POST[ 'obj_id' ] );
			$meta_key     = SucomUtil::sanitize_meta_key( $_POST[ 'meta_key' ] );
			$table_row_id = SucomUtil::sanitize_key( $metabox_id . '_' . $obj_id . '_' . $meta_key );
			$order_obj    = wc_get_order( $obj_id );
			$delete_cap   = apply_filters( 'jsmsom_delete_meta_capability', 'manage_options', $order_obj );
			$can_delete   = current_user_can( $delete_cap, $obj_id, $order_obj );

			if ( ! $can_delete ) die( -1 );

			$order_obj->delete_meta_data( $meta_key );	// Does not return true/false.

			$order_obj->save_meta_data();	// Does not return true/false.

			die( $table_row_id );
		}
	}
}
