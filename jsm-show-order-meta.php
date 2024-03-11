<?php
/*
 * Plugin Name: JSM Show Order Metadata for WooCommerce
 * Text Domain: jsm-show-order-meta
 * Domain Path: /languages
 * Plugin URI: https://surniaulula.com/extend/plugins/jsm-show-order-meta/
 * Assets URI: https://jsmoriss.github.io/jsm-show-order-meta/assets/
 * Author: JS Morisset
 * Author URI: https://surniaulula.com/
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Description: Show WooCommerce order metadata (aka custom fields) in a metabox when editing orders - a great tool for debugging issues with order metadata.
 * Requires PHP: 7.2.34
 * Requires At Least: 5.8
 * Tested Up To: 6.4.3
 * Version: 4.2.0-rc.1
 *
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *      {major}         Major structural code changes and/or incompatible API changes (ie. breaking changes).
 *      {minor}         New functionality was added or improved in a backwards-compatible manner.
 *      {bugfix}        Backwards-compatible bug fixes or small improvements.
 *      {stage}.{level} Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 *
 * Copyright 2024 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'JsmSom' ) ) {

	class JsmSom {

		private static $instance = null;	// JsmSom class object.

		public function __construct() {

			if ( ! is_admin() ) return;	// This is an admin-only plugin.

			$plugin_dir = trailingslashit( dirname( __FILE__ ) );

			require_once $plugin_dir . 'lib/config.php';

			JsmSomConfig::set_constants( __FILE__ );
			JsmSomConfig::require_libs( __FILE__ );

			add_action( 'init', array( $this, 'init_textdomain' ) );
			add_action( 'init', array( $this, 'init_objects' ) );
		}

		public static function &get_instance() {

			if ( null === self::$instance ) {

				self::$instance = new self;
			}

			return self::$instance;
		}

		public function init_textdomain() {

			load_plugin_textdomain( 'jsm-show-order-meta', false, 'jsm-show-order-meta/languages/' );
		}

		public function init_objects() {

			new JsmSomOrder();
			new JsmSomScript();
		}
	}

	JsmSom::get_instance();
}
