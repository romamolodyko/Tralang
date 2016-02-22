<?php
    namespace TralangBundle\Controller;


    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use TralangBundle\Entity\Binding;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use TralangBundle\Entity\Words;

    class AddController extends Controller
    {
        /**
         * @Route("/glossary", name = "glossary")
         */
        public function showWordsAction(){
            return $this->render('TralangBundle:AddWords:add.html.twig');
        }

        /**
         * @Route("/add", name = "add")
         */
        public function addWordAction(Request $request){
            $words = new Words();
            $ruWord = $request->get("russiaWord");
            $enWord = $request->get("englishWord");
            $words->setEnWord($enWord);
            $words->setRuWord($ruWord);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($words);
            $em->flush();
            $id = $words->getId();
            $b = $this->binding($id);
            if($b){

            }
            return $this->render("TralangBundle:AddWords:list-words.html.twig", array("id" => $id));
        }

        public function binding($idWord){
            $session = new Session();
            $idUser = $session->get('id');
            $binding = new Binding();
            $binding->setIdUser($idUser);
            $binding->setIdWords($idWord);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($binding);
            $em->flush();
            $id = $binding->getId();
            return $id;
        }
    }