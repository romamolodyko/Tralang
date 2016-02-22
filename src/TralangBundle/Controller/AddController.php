<?php
    namespace TralangBundle\Controller;


    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use TralangBundle\Entity\Users;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use TralangBundle\Entity\Words;

    class AddController extends Controller
    {
        /**
         * @Route("/glossary", name = "glossary")
         */
        public function getAllWordsAction(){
            $words = new Words();
            $session = new Session();
            $id = $session->get('id');
            return $this->render('TralangBundle:AddWords:list-words.htnl.twig');
        }
    }