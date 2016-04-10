<?php
namespace TralangBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use TralangBundle\Entity\Binding;
use Symfony\Component\HttpFoundation\Session\Session;
use TralangBundle\Entity\Words;

class AddGroupWordsController extends Controller
{
    public function addGroupAction(){
        $user = $this->getUser()->getId();
        $repository = $this->getDoctrine()->getRepository('TralangBundle:Words');
        $idWords = $repository->findBy(array('category' => 1));
        $this->binding($user, $idWords);
        return new Response('home');
    }

    public function binding($user, $idWords){
        foreach ($idWords as $word) {
            $binding = new Binding();
            $binding->setIdUser($user);
            $binding->setIdWords($word->getId());
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($binding);
            $em->flush();
        }
    }

}