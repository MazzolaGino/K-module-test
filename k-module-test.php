<?php

/**
 * Plugin Name: K Module Test
 * Description: K Module
 * Version: 0.0.2
 * Author: Mazzola Gino
 * Author URI: https://jrpgfr.net
 */

$autoloaderFile = __DIR__ . '/../k-module/vendor/autoload.php';

define('KLIB_WP_PLUGIN_DIR', WP_PLUGIN_DIR.'/K-module-test/src/');
define('KLIB_WP_PLUGIN_URL', WP_PLUGIN_URL.'/K-module-test/src/');


if (file_exists($autoloaderFile)) {
    require_once ($autoloaderFile);
}

(new \KLib\AppBuilder(KLIB_WP_PLUGIN_DIR, KLIB_WP_PLUGIN_URL))->getApp()->on();




