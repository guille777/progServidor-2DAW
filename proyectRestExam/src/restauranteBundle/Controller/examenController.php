<?php

namespace restauranteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use restauranteBundle\Entity\Usuarios;
use restauranteBundle\Form\UsuariosType;


class examenController extends Controller
{
    /**
    * @Route("/userfiltrado", name="userfiltrado")
    *Aqui filtramos por id, pero usando render mandamos array ya que no se puede imrimir un objeto solo
    */
     public function userfiltradoAction(){
        $repository = $this->getDoctrine()->getRepository('restauranteBundle:Usuarios');
        // muestra una tapa por id
        $user = $repository->findAll();
        return $this->render('restauranteBundle:examen:userfiltrado.html.twig',array('TablaUsers'=>$user) );
    }

     /**
    * @Route("/usermostrar/{id}", name="usermostrar")
    *Aqui filtramos por id, pero usando render mandamos array ya que no se puede imrimir un objeto solo
    */
     public function usermostrarAction($id){
        $repository = $this->getDoctrine()->getRepository('restauranteBundle:Usuarios');
        // muestra una tapa por id
        $user = $repository->findById($id);
        return $this->render('restauranteBundle:examen:usermostrar.html.twig',array('TablaUser'=>$user) );
    }
    // seteamos el rol a admin, tendria un registro para admin y otro form a user a esto quiero darle una vuelta...optimizar...
    /**
     * @Route("/userregister", name="userregister")
     */
     public function userregisterAction(Request $request)
       {
           // 1) build the form
           $usuario = new Usuarios();
           $form = $this->createForm(UsuariosType::class, $usuario);
 
           // 2) handle the submit (will only happen on POST)
           $form->handleRequest($request);
           if ($form->isSubmitted() && $form->isValid()) {
 
               // 3) Encode the password (you could also do this via Doctrine listener)
               $password = $this->get('security.password_encoder')->encodePassword($usuario, $usuario->getPlainPassword());
               $usuario->setPassword($password);
 
               // 4) save the User!
               $roles = ["ROLE_ADMIN"];
               $usuario->setRoles($roles);
               $DB = $this->getDoctrine()->getManager();
               $DB->persist($usuario);
               $DB->flush();
 
               // ... do any other work - like sending them an email, etc
               // maybe set a "flash" success message for the user
 
               return $this->redirectToRoute('usersexamen');
           }
 
        return $this->render('restauranteBundle:examen:userregister.html.twig',array('form' => $form->createView()));
    }

    /**
    * @Route("/userdelete/{id}", name="userdelete")
    */
    public function userdeleteAction($id)
    {
            $DB = $this->getDoctrine()->getManager();

            $eliminar = $DB->getRepository('restauranteBundle:Usuarios')->find($id);

            if (!$eliminar) {
                // throw $this->createNotFoundException('No se ha encontrado el id: '.$id);
                return $this->render('restauranteBundle:examen:usererror.html.twig');
            }
            $DB->remove($eliminar);
            $DB->flush();

        return $this->render("restauranteBundle:examen:userdelete.html.twig", array('TablaUser'=>$eliminar));
    }


    /**
    * @Route("/userupdate/{id}", name="userupdate")
    */
    public function userupdateAction(Request $request,$id)
    {

      $user = $this->getDoctrine()->getRepository('restauranteBundle:Usuarios')->find($id);

        if(!$user){return $this->redirectToRoute('usererror');}
        $form = $this->createForm(\restauranteBundle\Form\examenType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $DB = $this->getDoctrine()->getManager();
            $DB->persist($user);
            $DB->flush();
            return $this->redirectToRoute('usermostrar', ["id" => $id]);
        }
        return $this->render("restauranteBundle:examen:userupdate.html.twig", array('form'=>$form->createView() ));
    }

    /**
    * @Route("/login", name="login")
    */
    public function loginAction(Request $request)
    {
      $authenticationUtils = $this->get('security.authentication_utils');
 
      // obtener mensaje de error en el Login
      $error = $authenticationUtils->getLastAuthenticationError();
 
      // Coger el ultimo usuario que hemos insertado
      $lastUsername = $authenticationUtils->getLastUsername();
 
      return $this->render('restauranteBundle:Usuarios:login.html.twig', array(
          'last_username' => $lastUsername,
          'error'         => $error,
      ));
    }


    /**
    * @Route("/logout", name="logout")
    */
    public function logoutAction(){
            return $this->render('restauranteBundle:Usuarios:login.html.twig' );
    }

    /**
    * @Route("/usersexamen", name="usersexamen")
    */
    public function examenusersAction(){
        $repository = $this->getDoctrine()->getRepository('restauranteBundle:Usuarios');
       
        $usuario = $repository->findAll();
            return $this->render('restauranteBundle:examen:usersexamen.html.twig',array('TablaUsers'=>$usuario) );
    }

}
