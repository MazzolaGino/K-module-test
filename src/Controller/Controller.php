<?php

namespace KLibPlugin\Controller;

use KLib\App;
use KLib\AppBuilder;
use KLib\Base\BaseController;

/**
 * Summary of Controller
 */
class Controller extends BaseController
{
    /**
     * Summary of getApp
     * @return App
     */
    public function getApp(): App {
        $dir = WP_PLUGIN_DIR . '/K-module-test/src/';
        $url = WP_PLUGIN_URL . '/K-module-test/src/';

        return (new AppBuilder($dir, $url))->getApp();
    }

    public function getControllerName(): string
    {
        $class = get_class($this);
        $namespace = $this->getApp()->getCnf()->get('controller_namespace');
        $name = str_replace($namespace, '', $class);
        $name = str_replace('Controller', '', $name);

        return strtolower($name);
    }
}