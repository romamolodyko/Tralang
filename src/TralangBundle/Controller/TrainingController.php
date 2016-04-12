<?php
    namespace TralangBundle\Controller;


    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use TralangBundle\Entity\Users;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use TralangBundle\DQL;

    class TrainingController extends Controller
    {

        /**
         * @Route("/training/first-mode", name = "first-mode")
         */
        public function indexAction(){
            return $this->render("TralangBundle:Training:first-mode.html.twig");
        }

        /**
         * @Route("/training/getWords", name = "getWords")
         */
        public function getGroupWords(){
            $id = $this->getUser()->getId();
            $w = [];
            $w2 = [];
            $w3 = [];
            $count = 5;
            $c = 0;
            $c2 = 0;
            $em = $this->getDoctrine()->getEntityManager();
            $repository = $em->getRepository('TralangBundle:Binding');
            $arr = $repository->getRandomEntities($count, $id);
            foreach($arr as $p){
                $word = $em->getRepository('TralangBundle:Words')->findBy(array('id' => $p['id_word']));
                $w3['text'] = $w['words'][$p['id_word']]['text'] = $word[0]->getEnWords();
                $w3['textTranslate'] = $w['words'][$p['id_word']]['textTranslate'] = $word[0]->getRuWords();
                $w['word_seq'][$c] = $p['id_word'];
                $c++;
                $arr2 = $repository->getRandomOtherEntities($count=4, $id, $p['id_word']);
                foreach($arr2 as $p2){
                    $word2 = $em->getRepository('TralangBundle:Words')->findBy(array('id' => $p2['id_word']));
                    $w2[$p2['id_word']]['text'] = $word2[0]->getEnWords();
                    $w2[$p2['id_word']]['textTranslate'] = $word2[0]->getRuWords();
                    $w['words'][$p['id_word']]['mix_words'] = $w2;
                    $w['words'][$p['id_word']]['word_seq'][$c2] = $p2['id_word'];
                    $c2++;
                }
                $w['words'][$p['id_word']]['mix_words'][$p['id_word']] = $w3;
                $w['words'][$p['id_word']]['word_seq'][$c2] = $p['id_word'];
                $w2 = array();
                shuffle($w['words'][$p['id_word']]['word_seq']);
            }

            return new Response(json_encode($w, JSON_UNESCAPED_UNICODE));
        }
        /**
         * @Route("/training/setState", name = "setState")
         */
        public function setStateWords (Request $request) {
            $answers = $request->get('wordsAnswers');
            print_r($answers);

            return new Response("asdsa");
        }
    }