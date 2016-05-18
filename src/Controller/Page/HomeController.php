<?php

namespace Cekurte\TwitterLike\Controller\Page;

use Cekurte\TwitterLike\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    public function indexAction(Request $request)
    {
        return $this->render('Page/Home/index.twig.html', []);
    }
}
