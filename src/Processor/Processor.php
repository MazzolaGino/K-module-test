<?php

namespace KLibPlugin\Processor;

use KLib\App;
use KLib\AppBuilder;
use KLib\Base\BaseProcessor;

class Processor extends BaseProcessor
{
    /**
     *
     * @return App
     */
    public function getApp(): App
    {
        $dir = WP_PLUGIN_DIR . '/K-module-test/src/';
        $url = WP_PLUGIN_URL . '/K-module-test/src/';

        return (new AppBuilder($dir, $url))->getApp();
    }

    /**
     *
     * @return string
     */

    public function getProcessorName(): string
    {
        $class = get_class($this);
        $namespace = $this->getApp()->getCnf()->get('processor_namespace');
        $name = str_replace($namespace, '', $class);
        $name = str_replace('Processor', '', $name);

        return strtolower($name);
    }
}
