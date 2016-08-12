<?php
namespace Ankur\Plugins\WP_Tabs_Demo;

/**
 * Class Admin
 * @package Ankur\Plugins\WP_Tabs_Demo
 */
class Admin
{

    const PLUGIN_SLUG = 'tabs_demo';

    function __construct()
    {
        // Add settings link under admin->settings menu
        add_action('admin_menu', array($this, 'add_to_settings_menu'));

        // Add settings link to plugin list page
        add_filter('plugin_action_links_' . plugin_basename(WPTD_BASE_FILE), array($this, 'add_plugin_actions_links'), 10, 2);

    }


    /**
     * Adds link to Plugin Option page and do related stuff
     */
    public function add_to_settings_menu()
    {
        $page_hook_suffix = add_submenu_page(
            'options-general.php',
            'WP Tabs Demo', //page title
            'WP Tabs Demo', //menu text
            'manage_options', //capability
            self::PLUGIN_SLUG,
            array($this, 'load_options_page'));

        /* We can load additional css/js to our option page here */
        add_action('admin_print_scripts-' . $page_hook_suffix, array($this, 'add_admin_assets'));

    }

    /**
     * Function will print our option page form
     */
    public function load_options_page()
    {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        require plugin_dir_path(WPTD_BASE_FILE) . '/views/options-page.php';

    }

    /**
     * Adds a 'Settings' link for this plugin on plugin listing page
     *
     * @param $links
     * @return array  Links array
     */
    public function add_plugin_actions_links($links)
    {

        if (current_user_can('manage_options')) {
            $url = add_query_arg('page', self::PLUGIN_SLUG, 'options-general.php');
            array_unshift(
                $links,
                sprintf('<a href="%s">%s</a>', $url, __('Settings'))
            );
        }

        return $links;
    }

    /**
     * Print option page js,css
     */
    public function add_admin_assets()
    {
        wp_enqueue_script('wptd-admin', plugins_url("/js/option-page.js", WPTD_BASE_FILE), array('jquery'), WPTD_PLUGIN_VER, true);
        wp_enqueue_style('wptd-admin', plugins_url("/css/option-page.css", WPTD_BASE_FILE), array(), WPTD_PLUGIN_VER);
    }
}