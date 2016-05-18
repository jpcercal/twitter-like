<?php

use Cekurte\Environment\Environment;

return [
    'dbal' => [
        'db.options'    => [
            'driver'    => Environment::get('DB_DRIVER'),
            'host'      => Environment::get('DB_HOST'),
            'dbname'    => Environment::get('DB_NAME'),
            'user'      => Environment::get('DB_USERNAME'),
            'password'  => Environment::get('DB_PASSWORD'),
            'charset'   => Environment::get('DB_CHARSET'),
            'port'      => Environment::get('DB_PORT'),
        ],
    ],
    'orm' => [
        'orm.proxies_dir'           => ROOT_PATH . DS . Environment::get('DOCTRINE_ORM_PROXIES_DIRECTORY'),
        'orm.proxies_namespace'     => Environment::get('DOCTRINE_ORM_PROXIES_NAMESPACE'),
        'orm.auto_generate_proxies' => Environment::get('DOCTRINE_ORM_AUTO_GENERATE_PROXIES'),
        'orm.default_cache'         => Environment::get('DOCTRINE_ORM_DEFAULT_CACHE'),
        'orm.em.options' => [
            'mappings' => [
                [
                    'type'      => Environment::get('DOCTRINE_ORM_MAPPING_DEFAULT_TYPE'),
                    'namespace' => Environment::get('DOCTRINE_ORM_MAPPING_DEFAULT_NAMESPACE'),
                    'path'      => ROOT_PATH . DS . Environment::get('DOCTRINE_ORM_MAPPING_DEFAULT_PATH'),
                ],
            ],
        ],
    ],
];
