<?php

/**
 * Plugin Name: K Module Test
 * Description: K Module
 * Version: 0.0.1
 * Author: Mazzola Gino
 * Author URI: https://jrpgfr.net
 */
$autoloaderFile = __DIR__ . '/../k-module/vendor/autoload.php';

if (file_exists($autoloaderFile)) {
    require_once ($autoloaderFile);
}

use KLib\AppBuilder;

class TestBuilder extends AppBuilder
{
    /**
     *
     * @var TestBuilder
     */
    private static $instance;

    /**
     * Constructeur privé pour empêcher l'instanciation externe de la classe
     */
    private function __construct()
    {
        parent::__construct(plugin_dir_path(__FILE__), plugin_dir_url(__FILE__));
    }

    /**
     *
     * @return TestBuilder
     */
    public static function getInstance(): TestBuilder
    {
        if (is_null(self::$instance)) {
            self::$instance = new TestBuilder();
        }

        return self::$instance;
    }
}

TestBuilder::getInstance()->getApp()->execute();




