<?php

namespace cervezaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use cervezaBundle\Entity\cervecitas;
use cervezaBundle\Form\cervecitasType;
//añadimos Request para usar la insercion de form
use Symfony\Component\HttpFoundation\Request;

class CervecitasController extends Controller{

    //mostramos todos los campos de la tabla cervecitas
    public function allAction(){
    	$repository = $this->getDoctrine()->getRepository('cervezaBundle:cervecitas');
        // find *all* cervezas
        $cervezas = $repository->findAll();
 		     return $this->render('cervezaBundle:carpetaCervecitas:all.html.twig',array('TablaCervecitas' =>$cervezas));
    }

    /*/cervezas/{id} FILTRADO con findOneById  -findOneId devuelve un objeto, control para que si no hay cerveza en la consulta pare y redireige*/

    //mostramos filtrando por id, recibe un parametro
    public function idAction($id){
      $repository = $this->getDoctrine()->getRepository('cervezaBundle:cervecitas');
      // find *id* cerveza
      $cerveza = $repository->findOneById($id);
        if(!$cerveza){
          return $this->render('cervezaBundle:carpetaCervecitas:error.html.twig');
        }
        // hacer para que si esta vacio cuando llegue a id.twig
        return $this->render('cervezaBundle:carpetaCervecitas:id.html.twig',array("cervecita"=>$cerveza));
    }
  
    //insertamos pasandole dos parametros a la ruta, y lo demas a lo BRUTOO
    public function insertAction($nombre,$pais) {

        $objeto= new cervecitas();
        //usamos setters para cambiar a lo bruto, luego formularios get y post
        $objeto->setNombre($nombre);
        $objeto->setPais($pais);
        $objeto->setPoblacion('poblacion1');
        $objeto->setTipo("negra");
        $objeto->setImportacion("2");
        $objeto->setTamano(60);
        $objeto->setFechaAlamcen(\DateTime::createFromFormat("d/m/Y","24/12/2018"));
        $objeto->setCantidad(1);
        $objeto->setFoto("sanmi.jpg");

        //Entity Manager
        $em = $this->getDoctrine()->getEntityManager();
        //Persistimos en el objeto
        $em->persist($objeto);
        //Insertarmos en la base de datos
        $flush = $em->flush($objeto);

        //recogemos lo insertado?
        $repository = $this->getDoctrine()->getRepository('cervezaBundle:cervecitas');
        $id=$objeto->getId();
        $cervezas = $repository->findById($id);
          //porque esta casuistica con flush? no deberia ser diferente
          if ($flush == null) {
              echo "se ha creada correctamente";
          }else {
              echo "no se ha creado la Cerveza";
          }
        return $this->render("cervezaBundle:carpetaCervecitas:insert.html.twig",array('TablaCervecitas' =>$cervezas));
    }


    //FUNCION de actualizado, filtro por id y se "actualiza" a lo bruto con set desde dentro.... update de pastel
    public function updateAction($id){

    $em = $this->getDoctrine()->getManager();

    $product = $em->getRepository('cervezaBundle:cervecitas')->find($id);
      if (!$product) {
          throw $this->createNotFoundException(
              'No existe con ese id '.$id
          );
      }
    $product->setNombre('ValenciaCF');
    $product->setPais('shalke');
    $em->flush();

    $repository = $this->getDoctrine()->getRepository('cervezaBundle:cervecitas');
    $cervezas = $repository->findById($id);
      return $this->render("cervezaBundle:carpetaCervecitas:update.html.twig", array('TablaCervecitas'=>$cervezas ));
    }


    //filtramos por id y se programa logica para delete-remove
    public function deleteAction($id){

    $em = $this->getDoctrine()->getManager();
    $product = $em->getRepository('cervezaBundle:cervecitas')->find($id);

    // if (!$product) {
    //     throw $this->createNotFoundException(
    //         'No product found for id '.$id
    //     );
    // }

    $em->remove($product);
    $em->flush();

    return $this->render("cervezaBundle:carpetaCervecitas:delete.html.twig", array('TablaCervecitas'=>$product));
    }


    //funcion para crear form e insertar, desde 0, en blanco
    public function formAction(Request $request){

      $cerveza = new cervecitas();
      $form= $this->createForm(cervecitasType::class,$cerveza);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $cerveza = $form->getData();
 
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             $DB = $this->getDoctrine()->getManager();
             $DB->persist($cerveza);
             $DB->flush();
            //preparamos repository y accedemos, accedemos al id para mostrar mensaje y info
             $repository = $this->getDoctrine()->getRepository('cervezaBundle:cervecitas');
             $id=$cerveza->getId();
             $result = $repository->findById($id);
 
              return $this->render('cervezaBundle:carpetaCervecitas:vistas.html.twig', array('result'=>$result));
        }
       return $this->render("cervezaBundle:carpetaCervecitas:form.html.twig", array('form'=>$form->createView() ));
    }


    // Funcion que recibe un Id de mostrarTodasLasCervezas y nos sale el Formulario con los datos actuales del registro por id.
    public function formActuaAction(Request $request,$id)
    {
        $cerveza = $this->getDoctrine()->getRepository('cervezaBundle:cervecitas')->find($id);
        
        if(!$cerveza){return $this->redirectToRoute('all_cervecitas');}
        $form = $this->createForm(\cervezaBundle\Form\cervecitasType::class, $cerveza);
        $form->handleRequest($request);
     
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cerveza);
            $em->flush();
            return $this->redirectToRoute('cerveza_formUpdate', ["id" => $id]);
        }
        return $this->render("cervezaBundle:carpetaCervecitas:form.html.twig", array('form'=>$form->createView() ));
    }


}
