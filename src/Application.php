<?php

namespace Cekurte\TwitterLike;

use Silex\Application as SilexApplication;

class Application extends SilexApplication
{
    use \Silex\Application\TwigTrait;
    use \Silex\Application\UrlGeneratorTrait;
}
