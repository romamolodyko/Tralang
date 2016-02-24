<?php

namespace TralangBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TralangBundle\Entity\Users;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AuthController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function authAction(Request $request)
    {
        $name = "";
        $data = array();
        $data['error'] = array();
        $data['error'] = "";
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
                    $data['error'] = "That user doesn't exist";
                    }
            if ($data['error'] == ""){
                //return $this->redirectToRoute('homepage');
            }
            else{
                return new Response($data['error']);
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
        if(($_POST)){
            $userName = $request->get('name');
            $email = $request->get('email');
            $pass = $request->get('password');

            if(preg_match("#^[aA-zZ0-9]+$#", $userName) && preg_match("#^[aA-zZ0-9]+$#", $pass)){
                if(strlen(trim($userName)) <= 20 && strlen(trim($userName)) >= 3){
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                        if(strlen(trim($pass)) <=12 && strlen(trim($pass)) >= 3) {
                            $findUser = $this->findOne($email, $pass);
                            if(!$findUser){
                                $user = new Users();
                                $user->setName($userName);
                                $user->setEmail($email);
                                $user->setPassword($pass);

                                $em = $this->getDoctrine()->getEntityManager();
                                $em->persist($user);
                                $em->flush();

                                $this->setSession($userName, $user->getId());
                            }
                            else{
                                $data['error'] = "Пользователь с таким email уже существует";
                            }
                        }
                        else{
                            $data['error'] = "Некоректный пароль";
                        }
                    }
                    else {
                        $data['error'] = "Некоректный email";
                    }
                }
                else{
                    $data['error'] = "Некоректные даные в имени";
                }
            }
            else{
                $data['error'] = "Логин или пароль имеют недоступные символы";
            }
        }
        else{
            $data['error'] = "Заполните поля";
        }

        if(!$data['error']){
            return $this->render('TralangBundle:Training:choose-type.html.twig', array('name' => $userName));
        }
        else{
            return $this->render('TralangBundle:MainView:index.html.twig', array('error' => $data['error']));
        }

    }

    /**
     * @Route("/logout", name = "logout")
     */
    public function logOutAction(){
        $session = new Session();
        $session->clear();
        return $this->render("TralangBundle:MainView:index.html.twig");

    }

    public function setSession($name, $id){
        $session = new Session();
        $session->start();
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
}
