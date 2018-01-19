<?php

namespace restauranteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        return $this->render('restauranteBundle:Default:index.html.twig');
    }
    
    /**
     * @Route("/admin1", name="admin1")
     */
    public function admin1Action()
    {
        $repository = $this->getDoctrine()->getRepository('restauranteBundle:tapas');
        // find *all* cervezas
        $tapa = $repository->findAll();
        return $this->render('restauranteBundle:Default:admin1.html.twig',array('TablaTapas'=>$tapa) );
    }

}
