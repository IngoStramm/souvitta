<?php

add_action('cmb2_admin_init', 'gpx_register_options_metabox');

function gpx_register_options_metabox()
{
    global $gpx_pages_array, $gpx_moeda;

    $cmb_options = new_cmb2_box(array(
        'id'           => 'gpx_option_metabox',
        'title'        => esc_html__('Configurações Souvitta', 'svt'),
        'object_types' => array('options-page'),
        'option_key'      => 'gpx_options', // The option key and admin menu page slug.
        'icon_url'        => 'dashicons-admin-generic', // Menu icon. Only applicable if 'parent_slug' is left empty.
        'menu_title'      => esc_html__('Souvitta', 'svt'), // Falls back to 'title' (above).
        // 'parent_slug'     => 'themes.php', // Make options page a submenu item of the themes menu.
        // 'capability'      => 'manage_options', // Cap required to view options-page.
        // 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
        // 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
        // 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
        // 'save_button'     => esc_html__( 'Save Theme Options', 'svt' ), // The text for the options-page save button. Defaults to 'Save'.
    ));

    $cmb_options->add_field(array(
        'name'    => __('Página de login', 'svt'),
        'id'      => 'gpx_login_page',
        'type'    => 'select',
        'show_option_none' => true,
        'options_cb'   => function () {
            $pages = get_pages();
            $pages_array = [];
            foreach ($pages as $page) {
                $pages_array[$page->ID] = $page->post_title;
            }
            return $pages_array;
        }
    ));
}

function gpx_get_option($key = '', $default = false)
{
    if (function_exists('cmb2_get_option')) {
        // Use cmb2_get_option as it passes through some key filters.
        return cmb2_get_option('gpx_options', $key, $default);
    }

    // Fallback to get_option if CMB2 is not loaded yet.
    $opts = get_option('gpx_options', $default);

    $val = $default;

    if ('all' == $key) {
        $val = $opts;
    } elseif (is_array($opts) && array_key_exists($key, $opts) && false !== $opts[$key]) {
        $val = $opts[$key];
    }

    return $val;
}
