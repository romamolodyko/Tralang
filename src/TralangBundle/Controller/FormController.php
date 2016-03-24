<?php

namespace TralangBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TralangBundle\Entity\Users2;

class FormController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/new_task", name = "new_task")
     */
    public function newAction (Request $request)
    {
        $text = 'Symfony\Component\Form\Extension\Core\Type\TextType';
        $email = 'Symfony\Component\Form\Extension\Core\Type\EmailType';
        $pass = 'Symfony\Component\Form\Extension\Core\Type\PasswordType';
        $task = new Users2();

        $form = $this->createFormBuilder($task)
            ->add('name', $text)
            ->add('email', $email)
            ->add('password', $pass)->getForm();

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                return $this->redirect($this->generateUrl('main'));
            }
        }
        return $this->render('TralangBundle:Auth:default.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}