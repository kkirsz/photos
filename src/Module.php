<?php

namespace KKirsz\Photos;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class Module implements ConfigProviderInterface
{
    /**
     * 
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}