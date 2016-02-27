<?php
    namespace TralangBundle\Controller;


    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
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
            $session = new Session();
            $em = $this->getDoctrine()->getEntityManager();
            $repository = $em->getRepository('TralangBundle:Binding');
            $idWords = $repository->findBy(array('id_user' => $session->get('id')));
            if(!$idWords){
                print_r('empty');
            }
            else{
                $repository2 = $em->getRepository('TralangBundle:Words');
                arsort($idWords);
                foreach($idWords as $s){
                    $words[] = $repository2->findBy(array('id' => $s->getIdWords()));
                }
                return $this->render('TralangBundle:AddWords:list-words.html.twig', array('array' => $words, 'id' => true));
            }

            return $this->render('TralangBundle:AddWords:add.html.twig');
        }

        /**
         * @Route("/add", name = "add")
         */
        public function addWordAction(Request $request){
            $words = new Words();
            $ruWord = $request->get("russiaWord");
            $enWord = $request->get("englishWord");
            $em = $this->getDoctrine()->getEntityManager();
            $repository = $em->getRepository('TralangBundle:Words');
            $fword = $repository->findBy(array('en_words' => $enWord, 'ru_words' => $ruWord));
            if(!$fword){
                $words->setEnWord($enWord);
                $words->setRuWord($ruWord);
                $em->persist($words);
                $em->flush();
                $b = $this->binding($words->getId());
                return $this->render("TralangBundle:AddWords:set-one-word.html.twig", array("enWord" => $enWord, "ruWord" => $ruWord));;
            }
            else{
                $id = $fword[0]->getId();
                if(!$this->checkUserWord($id)){
                    $b = $this->binding($id);
                    return $this->render("TralangBundle:AddWords:set-one-word.html.twig", array("enWord" => $enWord, "ruWord" => $ruWord));;
                }
                else{
                    return new Response('false');
                }
            }

        }

        public function checkUserWord($idWord){
            $session = new Session();
            $em = $this->getDoctrine()->getEntityManager();
            $repository = $em->getRepository('TralangBundle:Binding');
            $idWords = $repository->findBy(array('id_word' => $idWord, 'id_user' => $session->get('id')));
            return $idWords;
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