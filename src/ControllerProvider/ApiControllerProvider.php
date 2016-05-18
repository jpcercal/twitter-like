<?php

namespace Cekurte\TwitterLike\ControllerProvider;

use Cekurte\TwitterLike\Controller\Api\PostController;
use Silex\Application;
use Silex\ControllerProviderInterface;

class ApiControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $app['api.post.controller'] = $app->share(function () use ($app) {
            return new PostController($app);
        });

        $controllers = $app['controllers_factory'];

        $controllers->get('/post', 'api.post.controller:indexAction')->bind('api.post');

        $controllers->post('/post', 'api.post.controller:createAction')->bind('api.post.create');

        return $controllers;
    }
}
