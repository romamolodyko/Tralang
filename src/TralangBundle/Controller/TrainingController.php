<?php
    namespace TralangBundle\Controller;


    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use TralangBundle\Entity\Users;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

    class TrainingController extends Controller
    {

        /**
         * @Route("/training/first-mode", name = "first-mode")
         */
        public function indexAction(){
            return $this->render("TralangBundle:Training:first-mode.html.twig");
        }



    }