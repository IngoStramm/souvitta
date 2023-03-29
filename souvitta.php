<?php

/**
 * Plugin Name: Souvitta
 * Plugin URI: https://agencialaf.com
 * Description: Descrição do Souvitta.
 * Version: 1.0.0
 * Author: Ingo Stramm
 * Text Domain: svt
 * License: GPLv2
 */

defined('ABSPATH') or die('No script kiddies please!');

define('SVT_DIR', plugin_dir_path(__FILE__));
define('SVT_URL', plugin_dir_url(__FILE__));

function gpx_debug($debug)
{
    echo '<pre>';
    var_dump($debug);
    echo '</pre>';
}

require_once 'tgm/tgm.php';
require_once 'classes/classes.php';
require_once 'scripts.php';
require_once 'post-type/post-type.php';
require_once 'taxonomy/taxonomy.php';
require_once 'settings.php';
require_once 'cmb.php';
require_once 'functions.php';

require 'plugin-update-checker-4.10/plugin-update-checker.php';
$updateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://raw.githubusercontent.com/IngoStramm/souvitta/master/info.json',
    __FILE__,
    'svt'
);
