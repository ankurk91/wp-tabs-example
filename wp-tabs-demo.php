<?php
namespace Ankur\Plugins\WP_Tabs_Demo;

/**
 * Plugin Name: WP Tabs Demo
 * Plugin URI: https://github.com/ankurk91/wp-tabs-example
 * Description: Demo plugin to demonstrate tabs on plugin options page
 * Version: 1.0.0
 * Author: Ankur Kumar
 * Author URI: http://ankurk91.github.io/
 * License: MIT
 * License URI: https://opensource.org/licenses/MIT
 * Text Domain: wp-tabs-demo
 * Domain Path: /languages
 */


define('WPTD_PLUGIN_VER', '1.0.0');
define('WPTD_BASE_FILE', __FILE__);

/**
 * Initiate required classes
 * Note: We are not using AJAX anywhere in this plugin
 */
if (is_admin() && (!defined('DOING_AJAX') || !DOING_AJAX)) {
    require_once __DIR__ . '/inc/class-admin.php';
    new Admin();
} else {
    require_once __DIR__ . '/inc/class-front-end.php';
    new FrontEnd();
}
