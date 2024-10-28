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
Requires PHP: 7.4.33
Requires At Least: 5.9
Tested Up To: 6.7.0
Stable Tag: 4.6.0

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

**Version 4.6.0 (2024/08/29)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Updated the `SucomUtil` and `SucomUtilWP` classes.
* **Requires At Least**
	* PHP v7.4.33.
	* WordPress v5.9.
	* WooCommerce v8.2.

== Upgrade Notice ==

= 4.6.0 =

(2024/08/29) Updated the `SucomUtil` and `SucomUtilWP` classes.

