<?php

return [
    'doctrine' => [
        
        'connection' => [
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'params' => [
                    'host'     => 'db',
                    'port'     => '3306',
                    'user'     => 'photos',
                    'password' => 'photos',
                    'dbname'   => 'photos',
                ],
            ],
        ],
        
        'driver' => [
            'photos_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\YamlDriver::class,
                'cache' => 'array',
                'extension' => '.yml',
                'paths' => [
                    __DIR__ . '/orm/Photo',
                ],
            ],
            
            'orm_default' => [
                'drivers' => [
                    'KKirsz\Photos\Domain\Photo' => 'photos_driver',
                ],
            ],
        ],
    ],
];
