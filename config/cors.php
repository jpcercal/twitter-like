<?php

use Cekurte\Environment\Environment;

return [
    'cors.allowOrigin'      => Environment::get('CORS_ALLOW_ORIGIN'),
    'cors.allowMethods'     => Environment::get('CORS_ALLOW_METHODS'),
    'cors.maxAge'           => Environment::get('CORS_MAX_AGE'),
    'cors.allowCredentials' => Environment::get('CORS_ALLOW_CREDENTIALS'),
    'cors.exposeHeaders'    => Environment::get('CORS_EXPOSE_HEADERS'),
];
