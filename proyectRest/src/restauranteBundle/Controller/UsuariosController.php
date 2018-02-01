<?php

namespace restauranteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use restauranteBundle\Entity\Usuarios;
use restauranteBundle\Form\UsuariosType;


class UsuariosController extends Controller
{

    /**
     * @Route("/register", name="register")
     */
     public function registerAction(Request $request)
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
 
               return $this->redirectToRoute('users');
           }
 
        return $this->render('restauranteBundle:Usuarios:register.html.twig',array('form' => $form->createView()));
    }


    /**
    * @Route("/users", name="users")
    */
    public function usersAction(){
        $repository = $this->getDoctrine()->getRepository('restauranteBundle:Usuarios');
        // find *all* cervezas
        $usuario = $repository->findAll();
            return $this->render('restauranteBundle:Usuarios:users.html.twig',array('TablaUsers'=>$usuario) );
    }

      public function usuariosAction()
    {
        return $this->render('restauranteBundle:Default:index.html.twig');
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
    * @Route("/filtrado", name="filtrado")
    *Aqui filtramos por id, pero usando render mandamos array ya que no se puede imrimir un objeto solo
    ?¿
    */
     public function filtradoAction(){
        $repository = $this->getDoctrine()->getRepository('restauranteBundle:Usuarios');
        // muestra una tapa por id
        $user = $repository->findAll();
        return $this->render('restauranteBundle:Usuarios:filtrado.html.twig',array('TablaUsers'=>$user) );
    }






      /**
    * @Route("/logout", name="logout")
    */
    public function logoutAction(){
            return $this->render('restauranteBundle:Usuarios:login.html.twig' );
    }




    








}
