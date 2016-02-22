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
        $session = new Session();
        $session->clear();
        return $this->render('TralangBundle:MainView:home.html.twig');
    }

    /**
     * @Route("/home", name="homepage")
     */
    public function showMainAction(){
        $session = new Session();
        $userName = $session->get('name');
        return $this->render('TralangBundle:MainView:home.html.twig');
    }

    /**
     * @Route("/chooseTraining", name="chooseTraining")
     */
    public function chooseTrainingAction(){
        return $this->render('TralangBundle:Training:choose-type.html.twig');
    }
}
