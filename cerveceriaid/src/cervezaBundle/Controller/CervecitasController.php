<?php

namespace cervezaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CervecitasController extends Controller
{
    public function allAction()
    {
    	$repository = $this->getDoctrine()->getRepository('cervezaBundle:cervecitas');
        // find *all* cervezas
        $cervezas = $repository->findAll();
 		return $this->render('cervezaBundle:carpetaCervecitas:all.html.twig',array('TablaCervecitas' =>$cervezas));
    }

    /*/cervezas/{id} FILTRADO con findOneById  -findOneId devuelve un objeto, control para que si no hay cerveza en la consulta pare y redireige*/
  public function idAction($id)
  {
      $repository = $this->getDoctrine()->getRepository('cervezaBundle:cervecitas');
      // find *id* cerveza
      $cerveza = $repository->findOneById($id);
        if(!$cerveza){
          return $this->render('cervezaBundle:carpetaCervecitas:error.html.twig');
        }
        // hacer para que si esta vacio
      return $this->render('cervezaBundle:carpetaCervecitas:id.html.twig',array("cervecita"=>$cerveza));
    }
}
