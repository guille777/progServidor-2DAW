<?php

namespace restauranteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use restauranteBundle\Entity\tapas;
use restauranteBundle\Form\tapasType;
use Symfony\Component\HttpFoundation\Request;

class tapasController extends Controller
{
    /**
    * @Route("/tapas", name="tapas")
    */
      public function tapasAction(){
        $repository = $this->getDoctrine()->getRepository('restauranteBundle:tapas');
        // find *all* tapas
        $tapas = $repository->findAll();
        return $this->render('restauranteBundle:tapas:tapas.html.twig',array('TablaTapas'=>$tapas) );
    }

    /**
    * @Route("/vistas", name="vistas")
    */
    public function vistasAction(){
        $repository = $this->getDoctrine()->getRepository('restauranteBundle:tapas');
        // find *all* cervezas
        $tapa = $repository->findAll();
            return $this->render('restauranteBundle:tapas:vistas.html.twig',array('TablaTapas'=>$tapa) );
    }

    /**
    * @Route("/mostrar/{id}", name="mostrar")
    *Aqui filtramos por id, pero usando render mandamos array ya que no se puede imrimir un objeto solo
    ?¿
    */
     public function mostrarAction($id){
        $repository = $this->getDoctrine()->getRepository('restauranteBundle:tapas');
        // muestra una tapa por id
        $tapa = $repository->findById($id);
        return $this->render('restauranteBundle:tapas:tapa.html.twig',array('TablaTapa'=>$tapa) );
    }
   
    /**
    * @Route("/tapas/insertar", name="insertar_tapas")
    */
    public function crearTapasAction(Request $request)
    {
        $tapa = new tapas();

        $form= $this->createForm(tapasType::class,$tapa);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $tapas = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             $DB = $this->getDoctrine()->getManager();
             $DB->persist($tapa);
             $DB->flush();

            return $this->redirectToRoute('vistas');
        }
        return $this->render('restauranteBundle:tapas:insertarTapas.html.twig',array('form' => $form->createView() ));
    }

    /**
    * @Route("/tapas/eliminar/{id}", name="eliminarTapas")
    */
    public function eliminarTapasAction($id)
    {
            $DB = $this->getDoctrine()->getManager();

            $eliminar = $DB->getRepository('restauranteBundle:tapas')->find($id);

            if (!$eliminar) {
                // throw $this->createNotFoundException('No se ha encontrado el id: '.$id);
                return $this->render('restauranteBundle:tapas:error.html.twig');
            }
            $DB->remove($eliminar);
            $DB->flush();

        return $this->render("restauranteBundle:tapas:eliminarTapas.html.twig", array('TablaTapas'=>$eliminar));
    }

  










}
