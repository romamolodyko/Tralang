<?php

namespace TralangBundle\Controller;

use Doctrine\DBAL\Types\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Test\FormBuilderInterface;
use Symfony\Component\Form\Tests\Extension\Core\Type\RepeatedTypeTest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use TralangBundle\Entity\User;
use TralangBundle\Entity\Users;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TralangBundle\Entity\UserType;

class AuthController extends Controller
{
    /**
     * @Route("/login1", name="login")
     */
    public function authAction(Request $request)
    {
        $name = "";
        $data = array();
        $data['error'] = array();
        $data['error'] = true;
        if($_GET){
            $email = $request->get('email');
            $password = $request->get('password');
            $em = $this->getDoctrine()->getEntityManager();
            $repository = $em->getRepository('TralangBundle:Users');
            $user = $repository->findOneBy(array('email' => $email, 'password' => $password));
                if($user){
                    $name = $user->getName();
                    $this->setSession($name, $user->getId());
                }
                else{
                    $data['error'] = false;
                    }
            if ($data['error'] == true){
                return new Response("glossary");
            }
            else{
                return new Response("false");
            }
        }
        return $this->render('TralangBundle:MainView:index.html.twig');
    }


    /**
     * @Route("/signUp", name="signUp")
     */
    public function regAction(Request $request){
        $data = array();
        $data['error'] = array();
        if(($_GET)){
            $userName = $request->get('name');
            $email = $request->get('email');
            $pass = $request->get('password');
            if(preg_match("#^[aA-zZ0-9]+$#", $userName) && preg_match("#^[aA-zZ0-9]+$#", $pass)){
                if(strlen(trim($userName)) <= 20 && strlen(trim($userName)) >= 3){
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                        if(strlen(trim($pass)) <=12 && strlen(trim($pass)) >= 5) {
                            $findUser = $this->findOne($email, $pass);
                            if(!$findUser){
                                $user = new Users();
                                $user->setName($userName);
                                $user->setEmail($email);
                                $user->setPassword($pass);

                                $em = $this->getDoctrine()->getEntityManager();
                                $em->persist($user);
                                $em->flush();
                                $name = $user->getName();
                                $this->setSession($name, $user->getId());
                            }
                            else{
                                $data['error'] = "That user exist";
                            }
                        }
                        else{
                            $data['error'] = "Incorrect password";
                        }
                    }
                    else {
                        $data['error'] = "Incorrect email";
                    }
                }
                else{
                    $data['error'] = "Invalid data in the name";
                }
            }
            else{
                $data['error'] = "Login or password are unavailable characters";
            }
        }
        else{
            $data['error'] = "Fill out the field";
        }

        if(!$data['error']){
            return new Response("true");
        }
        else{
            return new Response($data['error']);
        }

    }

    /**
     * @Route("/", name = "logout")
     */
    public function logOutAction(){
        $session = new Session();
        $session->clear();
        return $this->forward("TralangBundle:View:index");

    }

    public function setSession($name, $id){
        $session = new Session();
        //$session->start();
        $session->set('name', $name);
        $session->set('id', $id);
    }

    public function findOne($email){
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository("TralangBundle:Users");
        $user = $repository->findOneBy(array('email' => $email));
        if($user){
            return $user;
        }
        else return false;
    }


    /**
     * @param Request $req
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("\create", name="create")
     */
    public function createAction(Request $req)
    {
        $em   = $this->getDoctrine()->getManager();
        $form = $this->createForm(new \TralangBundle\Type\RegistrationType(), new User());
        $form->handleRequest($req);

        $user= new User();
        $user= $form->getData();

        $user->setCreated(new \DateTime());
        $user->setRoles('ROLE_USER');
        $user->setActive(true);

        $pwd=$user->getPassword();
        $encoder=$this->container->get('security.password_encoder');
        $pwd=$encoder->encodePassword($user, $pwd);
        $user->setPassword($pwd);

        $em->persist($user);
        $em->flush();

        $url = $this->generateUrl('login');
        return $this->redirect($url);
    }


}
