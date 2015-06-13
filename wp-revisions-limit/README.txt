=== WP Revisions Limit ===
Contributors: barragan
Tags: revision, revisions, admin, post revisions, page revisions
Requires at least: 3.6
Tested up to: 4.2
Stable tag: 1.0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple plugin that allows you to assign the number of revisions stored for your posts.

== Description ==

WordPress 3.6 allows users to control how many revisions are stored for each supported post type. No longer must you rely on the `WP_POST_REVISIONS` constant, which applied universally. This plugin provides an interface for this new functionality.

With this plugin enabled, simply visit **Settings >  Revisions Limit** to specify the number of revisions stored.

**Development is over on Bitbucket: https://bitbucket.org/rrodrigonuez/wp-revisions-limit**

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `wp-revisions-limit` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to **Settings > Revisions Limit** and set the options under **Revisions Options**.

== Frequently Asked Questions ==

= Where do I change the plugin's settings? =
Navigate to **Settings > Revisions Limit** in your WordPress Dashboard, and look for the **Revisions Options** section.

== Changelog ==

= 1.0.3 =
* Fixed bug when no limit exists on Plugin initialization.
* Updated Plugin internal version

= 1.0.2 =
* Removed default limit of revisions assigned by this plugin.

= 1.0.1 =
* Check if WP_POST_REVISIONS is already defined in wp-config.php file.

= 1.0.0 =
* Initial public release

== Screenshots ==

1. The plugin's settings section, found under **Settings > Revisions Limit**.