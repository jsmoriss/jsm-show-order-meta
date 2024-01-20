<?php
/*
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2012-2024 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'SucomUtil' ) ) {

	require_once dirname( __FILE__ ) . '/util.php';
}

if ( ! class_exists( 'SucomUtilMetabox' ) ) {

	class SucomUtilMetabox extends SucomUtil {

		public static function get_table_metadata( array $metadata, array $skip_keys, $obj, $obj_id, $metabox_id, $admin_l10n, array $titles ) {

			$metabox_id     = SucomUtil::sanitize_key( $metabox_id );	// Just in case.
			$md_filtered    = apply_filters( $metabox_id . '_metabox_table_metadata', $metadata, $obj );
			$skip_keys      = apply_filters( $metabox_id . '_metabox_table_skip_keys', $skip_keys, $obj );
			$del_icon_class = apply_filters( $metabox_id . '_delete_meta_icon_class', 'dashicons dashicons-table-row-delete' );
			$delete_cap     = apply_filters( $metabox_id . '_delete_meta_capability', 'manage_options', $obj );
			$can_delete     = current_user_can( $delete_cap, $obj_id );

			$metabox_html = self::get_table_metadata_css( $metabox_id );
			$metabox_html .= '<table><thead>' . "\n";
			$metabox_html .= '<tr>';
			$metabox_html .= $can_delete ? '<th class="del-column"></th>' : '';
			$metabox_html .= '<th class="key-column">' . $titles[ 'key' ] . '</th>';
			$metabox_html .= '<th class="value-column">' . $titles[ 'value' ] . '</th>';
			$metabox_html .= '</tr>' . "\n";
			$metabox_html .= '</thead><tbody>' . "\n";

			ksort( $md_filtered );

			$row_count = 0;

			foreach( $md_filtered as $meta_key => $value ) {

				foreach ( $skip_keys as $key_preg ) {

					if ( preg_match( $key_preg, $meta_key ) ) {

						continue 2;
					}
				}

				$row_count++;

				$is_added     = isset( $metadata[ $meta_key ] ) ? false : true;
				$meta_key     = SucomUtil::sanitize_meta_key( $meta_key );
				$meta_key_esc = esc_html( $meta_key );
				$value        = self::array_maybe_unserialize( $value );
				$value_esc    = esc_html( var_export( $value, true ) );
				$table_row_id = SucomUtil::sanitize_key( $metabox_id . '_' . $obj_id . '_' . $meta_key );
				$onclick_js   = 'sucomDeleteMeta( \'' . $metabox_id . '\', \'' . $obj_id . '\', \'' . $meta_key . '\', \'' . $admin_l10n . '\' );';
				$metabox_html .= $is_added ? '<tr class="added-meta">' : '<tr id="' . $table_row_id . '">';

				if ( $can_delete ) {

					$metabox_html .= '<td class="del-column">';
					$metabox_html .= $is_added ? '' : '<span class="' . $del_icon_class . '" onclick="' . $onclick_js . '"></span>';
					$metabox_html .= '</td>';
				}

				$metabox_html .= '<td class="key-column"><div><pre>' . $meta_key_esc . '</pre></div></td>';
				$metabox_html .= '<td class="value-column"><div><pre>' . $value_esc . '</pre></div></td>';
				$metabox_html .= '</tr>' . "\n";
			}

			if ( ! $row_count ) {

				$metabox_html .= '<tr>';
				$metabox_html .= $can_delete ? '<td class="del-column"></td>' : '';
				$metabox_html .= '<td class="key-column"><pre></pre></td>';
				$metabox_html .= '<td class="value-column"><pre></pre></td>';
				$metabox_html .= '</tr>' . "\n";
			}

			$metabox_html .= '</tbody></table>' . "\n";

			return $metabox_html;
		}

		public static function get_table_metadata_css( $metabox_id ) {

			$custom_style_css = '

				div#' . $metabox_id . '.postbox table {
					width:100%;
					max-width:100%;
					text-align:left;
					table-layout:fixed;
				}

				div#' . $metabox_id . '.postbox table tr.added-meta td {
					background-color:#eee;
				}

				div#' . $metabox_id . '.postbox table tr.added-meta td.del-column {
					background-color:inherit;
				}

				div#' . $metabox_id . '.postbox table .del-column {	/* th and td */
					padding-top:15px;
					padding-left:0;
					border:none;
					width:2em;
					color:red;
				}

				div#' . $metabox_id . '.postbox table .del-column span {
					font-size:1em;
					width:1em;
					height:1em;
				}

				div#' . $metabox_id . '.postbox table .del-column span:hover {
					cursor:pointer;
				}

				div#' . $metabox_id . '.postbox table .key-column {	/* th and td */
					width:30%;
				}

				div#' . $metabox_id . '.postbox table .value-column {	/* th and td */
					width:auto;
				}

				div#' . $metabox_id . '.postbox table td {
					padding:10px;
					vertical-align:top;
					border:1px dotted #ccc;
				}

				div#' . $metabox_id . '.postbox table td div {
					overflow-x:auto;
				}

				div#' . $metabox_id . '.postbox table td div pre {
					margin:0;
					padding:0;
				}
			';

			$custom_style_css = self::minify_css( $custom_style_css, $metabox_id );

			return '<style type="text/css">' . $custom_style_css . '</style>';
		}
	}
}
