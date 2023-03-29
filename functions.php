<?php

// add_action('wp_head', 'gpx_test');

function gpx_test()
{
    $current_theme = wp_get_theme();

    gpx_debug($current_theme->get('TextDomain'));
    gpx_debug($current_theme->get('ThemeURI'));
    gpx_debug($current_theme->get('AuthorURI'));
    gpx_debug($current_theme->get('Name'));
}

// Verifica se o usuário está logado quando estiver acesso a área restrita
add_action('get_header', 'gpx_area_restrita_managment');

function gpx_area_restrita_managment()
{
    if (!is_archive('documento') && !is_tax('categoria-documento') && !is_singular('documento'))
        return;

    if (is_user_logged_in())
        return;
    $gpx_login_page = gpx_get_option('gpx_login_page');

    if (!$gpx_login_page) {
        wp_safe_redirect(get_site_url());
        exit;
    } else {
        // gpx_debug($gpx_login_page);
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
        $curr_url = urlencode($protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

        // return gpx_debug(esc_url($curr_url));
        wp_safe_redirect(esc_url(get_page_link($gpx_login_page) . '?redirect=' . $curr_url));
        exit;
    }
}

// Exibe o formulário de login na página de login
add_filter('the_content', 'gpx_filter_login_page_content', 1);

function gpx_filter_login_page_content($content)
{
    $login_page = gpx_get_option('gpx_login_page');

    if (!is_singular() || !in_the_loop() || !is_main_query() || !$login_page) {
        return $content;
    }

    $post_id = get_the_ID();
    if ($post_id != $login_page)
        return $content;

    $redirect = isset($_GET['redirect']) && !empty($_GET['redirect']) ? $_GET['redirect'] : null;

    $args = array(
        'echo'          => false,
        'redirect'      => $redirect
    );
    $login_form = wp_login_form($args);
    return $login_form;
}

// Adiciona o link para recuperar a senha no formulário de login da página de login

add_action('login_form_bottom', 'gpx_add_lost_password_link');

function gpx_add_lost_password_link()
{
    return '<a href="' . esc_url(wp_lostpassword_url(get_permalink())) . '" target="_blank">' . __('Esqueceu a senha?', 'svt') . '</a>';
    //echo wp_lostpassword_url( get_permalink() );
}

// Add a filter to 'template_include' hook
// add_filter('template_include', 'gpx_force_template');

function gpx_force_template($template)
{
    $current_theme = wp_get_theme();
    if ($current_theme->get('Name') !== 'Betheme')
        return $template;

    // If the current url is an archive of any kind
    if (is_post_type_archive('documento') || is_tax('categoria-documento')) {
        // Set this to the template file inside your plugin folder
        $template = SVT_DIR . '/templates/archive-documento.php';
    }
    // Always return, even if we didn't change anything
    return $template;
}

// Adiciona a classe CSS no arquivo para carregar o layout da tela com sidebar
add_filter('body_class', 'gpx_custom_css_body_class');

function gpx_custom_css_body_class($classes)
{
    if (is_post_type_archive('documento') || is_tax('categoria-documento')) {
        $classes[] = 'with_aside';
        $classes[] = 'aside_left';
    }
    return $classes;
}
