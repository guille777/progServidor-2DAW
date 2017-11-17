<?php

namespace GuilleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('GuilleBundle:Default:index.html.twig');
    }

    /**
     * @Route("/empresas", name="empresas")
     */
    public function empresasAction()
    {
        return $this->render('GuilleBundle:Default:empresas.html.twig');
    }
    
    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        return $this->render('GuilleBundle:Default:login.html.twig');
    }

    /**
     * @Route("/registro", name="registro")
     */
    public function registroAction()
    {
        return $this->render('GuilleBundle:Default:registro.html.twig');
    }

    /**
     * @Route("/home2", name="home2")
     */
    public function home2Action()
    {
        return $this->render('GuilleBundle:Default:home2.html.twig');
    }

    /**
     * @Route("/horarios", name="horarios")
     */
    public function horariosAction()
    {
        return $this->render('GuilleBundle:Default:horarios.html.twig');
    }

    /**
     * @Route("/sede/{ciudad}", name="sede")
     */
    public function sedeAction($ciudad){
        return $this->render('GuilleBundle:Default:sede.html.twig',array('ciudad'=>$ciudad));
    }
}
