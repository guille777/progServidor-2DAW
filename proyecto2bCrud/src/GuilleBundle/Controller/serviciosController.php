<?php

namespace GuilleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GuilleBundle\Form\ServiciosType;
use GuilleBundle\Entity\Servicios;
use GuilleBundle\Entity\Usuarios;
use Symfony\Component\HttpFoundation\Request;


class serviciosController extends Controller
{
    
    //mostramos todos los campos de la tabla Servicios

    /**
     * @Route("/vistas", name="vistas")
     */
    public function allAction(){
        $repository = $this->getDoctrine()->getRepository('GuilleBundle:Servicios');
        // find *all* cervezas
        $servicios = $repository->findAll();
        return $this->render('GuilleBundle:Carpeta_Servicios:vistas.html.twig',array('TablaServicios'=>$servicios) );
    }

    //mostramos filtrando por id, recibe un parametro

    /**
     * @Route("/id/{id}", name="id")
     */
    public function idAction($id){
      $repository = $this->getDoctrine()->getRepository('GuilleBundle:Servicios');
      // find *id* cerveza
      $serv = $repository->findById($id);
        if(!$serv){
          return $this->render('GuilleBundle:Carpeta_Servicios:error.html.twig');
        }
        // hacer para que si esta vacio cuando llegue a id.twig
        return $this->render('GuilleBundle:Carpeta_Servicios:id.html.twig',array("servicio"=>$serv));
    }

    /**
     * @Route("/servicio/insertar", name="insertar_servicio")
     */
    public function crearServicioAction(Request $request)
    {
        $servicio = new Servicios();

        $form= $this->createForm(ServiciosType::class,$servicio);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $servicio = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             $DB = $this->getDoctrine()->getManager();
             $DB->persist($servicio);
             $DB->flush();

            return $this->redirectToRoute('vistas');
        }
        return $this->render('GuilleBundle:Carpeta_Servicios:insertarServicio.html.twig',array('form' => $form->createView() ));
    }

    /**
     * @Route("/servicio/actualizar/{id}", name="actualizarServicio")
     */
    public function actualizarServicioAction(Request $request,$id)
    {
        $servicio = $this->getDoctrine()->getRepository('GuilleBundle:Servicios')->find($id);
          if (!$servicio){
            return $this->redirectToRoute('vistas');
          }
        $form = $this->createForm(\GuilleBundle\Form\ServiciosType::class, $servicio);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $DB = $this->getDoctrine()->getManager();
            $DB->persist($servicio);
            $DB->flush();
            return $this->redirectToRoute('actualizarServicio', ["id" => $id]);
        }
        return $this->render("GuilleBundle:Carpeta_Servicios:actualizarServicio.html.twig", array('form'=>$form->createView() ));
    }

    /**
     * @Route("/servicio/eliminar/{id}", name="eliminarServicio")
     */
    public function eliminarServicioAction($id)
    {
            $DB = $this->getDoctrine()->getManager();

            $eliminar = $DB->getRepository('GuilleBundle:Servicios')->find($id);

            if (!$eliminar) {
                throw $this->createNotFoundException('No se ha encontrado el id: '.$id);
            }
            $DB->remove($eliminar);
            $DB->flush();

        return $this->render("GuilleBundle:Carpeta_Servicios:eliminarServicio.html.twig", array('TablaServicio'=>$eliminar));
    }

    // ya tenemos esta entity-tabla relacionada con Usuarios manytoMany muchos a muchos y generada tabla intermedia,
}
