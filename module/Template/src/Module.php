<?php
/**
 * @author Corneliu Iancu
 * @date 22.03.2017
 * @license   
 */

namespace Template;

class Module
{
    const VERSION = '1.0.0-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
