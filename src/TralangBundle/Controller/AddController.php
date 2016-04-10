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
            $user = $this->getUser()->getId();
            $words = [];
            $em = $this->getDoctrine()->getEntityManager();
            $repository = $em->getRepository('TralangBundle:Binding');
            $idWords = $repository->findBy(array('id_user' => $user));
            if(!$idWords){
                $err = "Add a words!";
                return $this->render("TralangBundle:AddWords:add.html.twig", array('empty' => $err));
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
            $session = new Session();
            $idUser = $session->get('id');
            $words = new Words();
            $ruWord = $request->get("russiaWord");
            $enWord = $request->get("englishWord");
            $em = $this->getDoctrine()->getEntityManager();
            $repository = $em->getRepository('TralangBundle:Words');
            $fword = $repository->findBy(array('en_words' => $enWord, 'ru_words' => $ruWord));
            if(!$fword){
                $words->setEnWords($enWord);
                $words->setRuWords($ruWord);
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

        /**
         * @Route("/delete", name = "delete")
         */
        public function deleteWordAction(Request $request){
            $id = $request->get('id');
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TralangBundle:Binding')->findOneBy(array('id_word' => $id));
            if ($entity != null){
                $em->remove($entity);
                $em->flush();
                return new Response("true");
            }
            else{
                return new Response("false");
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