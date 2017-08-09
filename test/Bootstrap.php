<?php

declare(strict_types=1);

namespace KKirsz\Photos\Test;

use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;
use RuntimeException;
use UnexpectedValueException;

error_reporting(E_ALL | E_STRICT);
chdir(dirname(__DIR__));

/**
 * @author Korneliusz Kirsz <kornel.kirsz@gmail.com>
 */
class Bootstrap
{
    /**
     *
     * @var ServiceManager
     */
    private static $serviceManager;
    
    /**
     *
     * @throws RuntimeException
     */
    public static function init()
    {
        if (!file_exists('vendor/autoload.php')) {
            throw new RuntimeException(
                'File vendor/autoload.php was not found. Run `composer install`'
            );
        }
        include 'vendor/autoload.php';
                
        if (!file_exists('config/application.config.php')) {
            throw new RuntimeException(
                'File config/application.config.php was not found'
            );
        }
        $config = include 'config/application.config.php';
        
        $serviceManager       = new ServiceManager();
        $serviceManagerConfig = new ServiceManagerConfig();
        $serviceManagerConfig->configureServiceManager($serviceManager);
        $serviceManager->setService('ApplicationConfig', $config);
        $serviceManager->get('ModuleManager')->loadModules();
        
        $name = 'doctrine.entitymanager.orm_default';
        if ($serviceManager->has($name)) {
            $serviceManager->setShared($name, false);
        }
        
        static::$serviceManager = $serviceManager;
    }
    
    /**
     *
     * @return ServiceManager
     * @throws UnexpectedValueException
     */
    public static function serviceManager() : ServiceManager
    {
        if (null === self::$serviceManager) {
            throw new UnexpectedValueException();
        }
        return static::$serviceManager;
    }
}

Bootstrap::init();
