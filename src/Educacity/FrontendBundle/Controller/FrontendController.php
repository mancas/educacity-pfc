<?php

namespace Educacity\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontendController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontendBundle:Pages:home.html.twig');
    }
}
