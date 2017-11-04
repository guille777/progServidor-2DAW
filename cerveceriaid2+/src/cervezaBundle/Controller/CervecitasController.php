<?php

namespace cervezaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use cervezaBundle\Entity\cervecitas;

class CervecitasController extends Controller{

    public function allAction(){
    	$repository = $this->getDoctrine()->getRepository('cervezaBundle:cervecitas');
        // find *all* cervezas
        $cervezas = $repository->findAll();
 		     return $this->render('cervezaBundle:carpetaCervecitas:all.html.twig',array('TablaCervecitas' =>$cervezas));
    }

    /*/cervezas/{id} FILTRADO con findOneById  -findOneId devuelve un objeto, control para que si no hay cerveza en la consulta pare y redireige*/
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
  
    //hecho sin paso de tres parametros se lo seteamos directo
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








// public function updateAction($id)
//    {
//      $repository = $this->getDoctrine()->getRepository('cervezaBundle:cervecitas');
//      // find *id* cerveza
//      $cerveza = $repository->findOneById($id);
//      $em->remove($cerveza);
//      $em->flush($cerveza);
//            if(!$cerveza){
//          return $this->render('cervezaBundle:carpetaCervecitas:error.html.twig');
//        }
//         // hacer para que si esta vacio cuando llegue a id.twig
//      return $this->render('cervezaBundle:carpetaCervecitas:update.html.twig',array("cervecita"=>$cerveza));
 //    }
}
