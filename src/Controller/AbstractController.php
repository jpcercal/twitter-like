<?php

namespace Cekurte\TwitterLike\Controller;

use Silex\Application;

/**
 * AbstractController
 */
abstract class AbstractController
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @return Silex\Application
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * Render a view using the Twig Template Engine
     *
     * @param  string $view
     * @param  array  $params
     *
     * @return string
     */
    public function render($view, array $params = [])
    {
        $app = $this->getApp();

        if (!isset($app['twig'])) {
            throw new \RuntimeException('The TwigServiceProvider is not registered in this application');
        }

        return $app['twig']->render(sprintf('Resources/views/%s', $view), $params);
    }
}
