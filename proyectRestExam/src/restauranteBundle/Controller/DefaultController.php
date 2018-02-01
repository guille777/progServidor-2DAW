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
     * @Route("/admin", name="admin")
     */
    public function adminAction()
    {
        $repository = $this->getDoctrine()->getRepository('restauranteBundle:tapas');
        // find *all* cervezas
        $tapa = $repository->findAll();
        return $this->render('restauranteBundle:Default:admin.html.twig',array('TablaTapas'=>$tapa) );
    }

     /**
     * @Route("/admin/panel", name="adminpanel")
     */
    public function adminpanelAction()
    {
        $repository = $this->getDoctrine()->getRepository('restauranteBundle:tapas');
        // find *all* cervezas
        $tapa = $repository->findAll();
        return $this->render('restauranteBundle:Default:adminpanel.html.twig',array('TablaTapas'=>$tapa) );
    }
     /**
     * @Route("/cud", name="cud")
     */
    public function cudAction()
    {
        $repository = $this->getDoctrine()->getRepository('restauranteBundle:tapas');
        // find *all* cervezas
        $tapa = $repository->findAll();
        return $this->render('restauranteBundle:tapas:cud.html.twig',array('TablaTapas'=>$tapa) );
    }


}
