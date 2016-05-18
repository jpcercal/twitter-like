<?php

define('DS', DIRECTORY_SEPARATOR);

define('ROOT_PATH', realpath(__DIR__));

define('PUBLIC_PATH', realpath(ROOT_PATH . DS . 'public'));
define('APP_PATH', realpath(ROOT_PATH . DS . 'src'));
define('VENDOR_PATH', realpath(ROOT_PATH . DS . 'vendor'));
define('CONFIG_PATH', realpath(ROOT_PATH . DS . 'config'));
define('STORAGE_PATH', realpath(ROOT_PATH . DS . 'storage'));

define('STORAGE_PATH_CACHE', realpath(STORAGE_PATH . DS . 'cache'));
define('STORAGE_PATH_LOG', realpath(STORAGE_PATH . DS . 'logs'));

$loader = require VENDOR_PATH . DS . 'autoload.php';
require CONFIG_PATH . DS . 'dotenv.php';

\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(array($loader, 'loadClass'));
