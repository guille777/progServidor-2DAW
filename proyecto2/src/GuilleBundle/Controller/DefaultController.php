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
     * @Route("/servicios", name="servicios")
     */
    public function serviciosAction()
    {
        return $this->render('GuilleBundle:Default:servicios.html.twig');
    }

    /**
     * @Route("/empresas", name="empresas")
     */
    public function empresasAction()
    {
        return $this->render('GuilleBundle:Default:empresas.html.twig');
    }

    /**
     * @Route("/index2", name="index2")
     */
    public function index2Action()
    {
        return $this->render('GuilleBundle:Default:index2.html.twig');
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
     * @Route("/sede/{ciudad}", name="sede")
     */
    public function sedeAction($ciudad){
        return $this->render('GuilleBundle:Default:sede.html.twig',array('ciudad'=>$ciudad));
    }

    /**
     * @Route("/horarios", name="horarios")
     */
    public function horariosAction()
    {
        return $this->render('GuilleBundle:Default:horarios.html.twig');
    }

    /**
     * @Route("/lista", name="lista")
     */
    // public function listaAlumnos(){
    //   $repository = $this->getDoctrine()->getRepository(Usuarios::class);
    //     return $this->render('GuilleBundle:Default:lista.html.twig');
    // }
}
