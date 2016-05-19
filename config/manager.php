<?php

$doctrine = require CONFIG_PATH . DS . 'doctrine.php';

return [
    'Silex\Provider\DoctrineServiceProvider' => [
        'register' => true,
        'type'     => 'array',
        'src'      => $doctrine['dbal'],
    ],
    'Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider' => [
        'register' => true,
        'type'     => 'array',
        'src'      => $doctrine['orm'],
    ],
    'Cekurte\TwitterLike\ServiceProvider\DoctrineExtensionsServiceProvider' => [
        'register' => true,
    ],
    'Silex\Provider\HttpFragmentServiceProvider' => [
        'register' => true,
    ],
    'Silex\Provider\ServiceControllerServiceProvider' => [
        'register' => true,
    ],
    'Silex\Provider\UrlGeneratorServiceProvider' => [
        'register' => true,
    ],
    'Silex\Provider\ValidatorServiceProvider' => [
        'register' => true,
    ],
    'Saxulum\Validator\Silex\Provider\SaxulumValidatorProvider' => [
        'register' => true,
    ],
    'Silex\Provider\HttpCacheServiceProvider' => [
        'register' => true,
        'type'     => 'php',
        'src'      => CONFIG_PATH . DS . 'httpcache.php',
    ],
    'Silex\Provider\TwigServiceProvider' => [
        'register' => true,
        'type'     => 'php',
        'src'      => CONFIG_PATH . DS . 'twig.php',
    ],
    'JDesrosiers\Silex\Provider\CorsServiceProvider' => [
        'register' => true,
        'type'     => 'php',
        'src'      => CONFIG_PATH . DS . 'cors.php',
    ],
    'JDesrosiers\Silex\Provider\JmsSerializerServiceProvider' => [
        'register' => true,
        'type'     => 'php',
        'src'      => CONFIG_PATH . DS . 'serializer.php',
    ],
];
