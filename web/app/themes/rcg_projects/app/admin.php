<?php

/**
 * Theme admin.
 */

namespace App;

use WP_Customize_Manager;

use function Roots\asset;

/**
 * Register the `.brand` selector as the blogname.
 *
 * @param  \WP_Customize_Manager $wp_customize
 * @return void
 */
add_action('customize_register', function (WP_Customize_Manager $wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector' => '.brand',
        'render_callback' => function () {
            bloginfo('name');
        }
    ]);
});

/**
 * Register the customizer assets.
 *
 * @return void
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset('scripts/customizer.js')->uri(), ['customize-preview'], null, true);
});

add_action('wp_dashboard_setup', function () {
    remove_action('welcome_panel', 'wp_welcome_panel');
    remove_meta_box('health_check_status', 'dashboard', 'normal');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
});
add_action(
    'admin_bar_menu',
    function ($bar) {
        //$bar = $this->removeHowdy($bar);
        $bar->remove_node('about');
        $bar->remove_node('wporg');
        $bar->remove_node('comments');
        $bar->remove_node('feedback');
        $bar->remove_node('support-forums');
        $bar->remove_node('wp-logo-external');
        $bar->remove_node('documentation');
        $bar->remove_node('new-content');

        return $bar;
    },
    999
);
add_filter(
    'admin_menu',
    function (): void {
        //remove_menu_page('tools.php');
        remove_menu_page('gutenberg');
        //remove_menu_page('plugins.php');
        remove_menu_page('edit.php');
        remove_menu_page('edit-comments.php');
        //remove_menu_page('wp_stream');
        remove_menu_page('wp-graphiql/wp-graphiql.php');
        //remove_menu_page('themes.php');
        remove_submenu_page('options-general.php', 'options-media.php');
        remove_submenu_page('options-general.php', 'options-privacy.php');
        remove_submenu_page('options-general.php', 'options-writing.php');
        //remove_submenu_page('options-general.php', 'options-reading.php');
        //remove_submenu_page('options-general.php', 'options-permalink.php');
        remove_submenu_page('options-general.php', 'disable_comments_settings');
        remove_submenu_page('options-general.php', 'duplicatepost');
        remove_submenu_page('options-general.php', 'options-discussion.php');
        add_menu_page(
            'Menus',
            'Menus',
            'manage_options',
            '/nav-menus.php',
            null,
            'dashicons-menu-alt3'
        );
    },
    999
);

//add_filter('acf/settings/show_admin', '__return_false');
