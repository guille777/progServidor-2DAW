<?php

namespace cervezaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('cervezaBundle:Default:index.html.twig');
    }
}
