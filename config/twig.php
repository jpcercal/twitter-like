<?php

use Cekurte\Environment\Environment;

return [
    'twig.path'       => APP_PATH,
    'twig.class_path' => VENDOR_PATH . DS . 'twig' . DS . 'twig' . DS . 'lib',
    'twig.options'    => [
        'cache'       => STORAGE_PATH_CACHE . DS . 'twig.cache',
        'debug'       => Environment::get('APP_DEBUG'),
    ],
];
