<?php

namespace TralangBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class ViewController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function indexAction(){
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->render('TralangBundle:MainView:index.html.twig');
        }
        else {
            return $this->forward("TralangBundle:View:showMain");
        }
    }

    /**
     * @Route("/home", name="homepage")
     */
    public function showMainAction(){


        return $this->render('TralangBundle:MainView:home.html.twig', array(

        ));
    }
}
