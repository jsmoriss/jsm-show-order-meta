=== JSM Show Order Metadata for WooCommerce HPOS ===
Plugin Name: JSM Show Order Metadata for WooCommerce HPOS
Plugin Slug: jsm-show-order-meta
Text Domain: jsm-show-order-meta
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://jsmoriss.github.io/jsm-show-order-meta/assets/
Tags: woocommerce, orders, custom fields, metadata, inspector
Contributors: jsmoriss
Requires PHP: 7.2.34
Requires At Least: 5.8
Tested Up To: 6.6.1
Stable Tag: 4.5.0

Show WooCommerce order metadata in a metabox when editing HPOS orders - a great tool for debugging issues with HPOS order metadata.

== Description ==

The JSM Show Order Metadata for WooCommerce HPOS plugin displays order meta keys and their unserialized values in a metabox at the bottom of the HPOS order editing page.

If you are not using WooCommerce HPOS (High-Performance Order Storage), available since WooCommerce v8.2, then your WooCommerce orders are post objects and you should use the [JSM Show Post Metadata](https://wordpress.org/plugins/jsm-show-post-meta/) plugin instead.

There are no plugin settings - simply install and activate the plugin.

= Available Filters for Developers =

Filter the order meta shown in the metabox:

<pre><code>'jsmsom_metabox_table_metadata' ( array $metadata, $order_obj )</code></pre>

Array of regular expressions to exclude meta keys:

<pre><code>'jsmsom_metabox_table_exclude_keys' ( array $exclude_keys, $order_obj )</code></pre>

Capability required to show order meta:

<pre><code>'jsmsom_show_metabox_capability' ( 'manage_options', $order_obj )</code></pre>

Capability required to delete order meta:

<pre><code>'jsmsom_delete_meta_capability' ( 'manage_options', $order_obj )</code></pre>

Icon for the delete order meta button:

<pre><code>'jsmsom_delete_meta_icon_class' ( 'dashicons dashicons-table-row-delete' )</code></pre>

= Related Plugins =

* [JSM Show Comment Metadata](https://wordpress.org/plugins/jsm-show-comment-meta/)
* [JSM Show Order Metadata for WooCommerce HPOS](https://wordpress.org/plugins/jsm-show-order-meta/)
* [JSM Show Post Metadata](https://wordpress.org/plugins/jsm-show-post-meta/)
* [JSM Show Term Metadata](https://wordpress.org/plugins/jsm-show-term-meta/)
* [JSM Show User Metadata](https://wordpress.org/plugins/jsm-show-user-meta/)
* [JSM Show Registered Shortcodes](https://wordpress.org/plugins/jsm-show-registered-shortcodes/)

== Installation ==

== Frequently Asked Questions ==

== Screenshots ==

01. The "Order Metadata" metabox added to admin WooCommerce order editing pages.

== Changelog ==

<h3 class="top">Version Numbering</h3>

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes and/or incompatible API changes (ie. breaking changes).
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

<h3>Repositories</h3>

* [GitHub](https://jsmoriss.github.io/jsm-show-order-meta/)
* [WordPress.org](https://plugins.trac.wordpress.org/browser/jsm-show-order-meta/)

<h3>Changelog / Release Notes</h3>

**Version 4.6.0-dev.3 (2024/08/28)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Updated the `SucomUtil` and `SucomUtilWP` classed.
* **Requires At Least**
	* PHP v7.2.34.
	* WordPress v5.8.
	* WooCommerce v8.2.

**Version 4.5.0 (2024/08/16)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Removed deprecated methods from the `SucomUtil` class.
* **Requires At Least**
	* PHP v7.2.34.
	* WordPress v5.8.
	* WooCommerce v8.2.

**Version 4.4.0 (2024/08/12)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Updated the jquery-admin-page.js functions (version 20240810).
* **Requires At Least**
	* PHP v7.2.34.
	* WordPress v5.8.
	* WooCommerce v8.2.

**Version 4.3.0 (2024/04/18)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Updated the `SucomUtil` class.
* **Requires At Least**
	* PHP v7.2.34.
	* WordPress v5.8.
	* WooCommerce v8.2.

**Version 4.2.0 (2024/03/10)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Added extra sanitation for method arguments in `SucomUtilMetabox::get_table_metadata()`.
	* Added extra sanitation for 'post_ID' and 'action' values in `SucomUtilWP::doing_block_editor()`.
* **Requires At Least**
	* PHP v7.2.34.
	* WordPress v5.8.
	* WooCommerce v8.2.

**Version 4.1.0 (2024/02/03)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Added a new `SucomUtilWP::doing_dev()` method.
* **Requires At Least**
	* PHP v7.2.34.
	* WordPress v5.8.
	* WooCommerce v8.2.

**Version 4.0.0 (2024/01/20)**

Initial release.

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* None.
* **Requires At Least**
	* PHP v7.2.34.
	* WordPress v5.8.
	* WooCommerce v8.2.

== Upgrade Notice ==

= 4.6.0-dev.3 =

(2024/08/28) Updated the `SucomUtil` and `SucomUtilWP` classed.

= 4.5.0 =

(2024/08/16) Removed deprecated methods from the `SucomUtil` class.

= 4.4.0 =

(2024/08/12) Updated the jquery-admin-page.js functions (version 20240810).

= 4.3.0 =

(2024/04/18) Updated the `SucomUtil` class.

= 4.2.0 =

(2024/03/10) Added extra sanitation.

= 4.1.0 =

(2024/02/03) Added a new `SucomUtilWP::doing_dev()` method.

= 4.0.0 =

(2024/01/20) Initial release.

