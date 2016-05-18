<?php

use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\Debug\ErrorHandler;

ErrorHandler::register();
ExceptionHandler::register($app['debug']);

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        throw $e;
    }
});
