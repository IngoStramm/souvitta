<?php

add_action('wp_enqueue_scripts', 'gpx_frontend_scripts');

function gpx_frontend_scripts()
{

    $min = (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', '10.0.0.3'))) ? '' : '.min';

    if (empty($min)) :
        wp_enqueue_script('souvitta-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true);
    endif;

    wp_register_script('souvitta-script', SVT_URL . 'assets/js/souvitta' . $min . '.js', array('jquery'), '1.0.0', true);

    wp_enqueue_script('souvitta-script');

    wp_localize_script('souvitta-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    wp_enqueue_style('souvitta-style', SVT_URL . 'assets/css/souvitta.css', array(), false, 'all');
}
