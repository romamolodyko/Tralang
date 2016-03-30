<?php
namespace TralangBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use TralangBundle\Form;
use TralangBundle\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="registration")
     * @Method("POST")
     */
    public function registerAction(Request $request)
    {
        // 1) build the form
        $user = new Entity\User();
        $form = $this->createForm(Form\UserType::class, $user);
        $form->handleRequest($request);
        // 2) handle the submit (will only happen on POST)
        $errors = $this->_getErrors($form);
        if (!$errors) {
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            //$role = new Entity\Role();
            $role[] = 'ROLE_ADMIN';
            $user->setRoles($role);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $token = new UsernamePasswordToken($user,null,'main',$user->getRoles());
            $this->get('security.token_storage')->setToken($token);
            //$log = $this->forward('TralangBundle:Login:loginCheck');
            return new Response('home');
        }
        return new Response(json_encode($errors));
        /*return $this->render(
            'TralangBundle:Auth:signup.html.twig',
            array('form' => $form->createView())
        );*/
    }

    protected function _getErrors($form)
    {
        // Validate form
        $errors = $this->get('validator')->validate($form);

        // Prepare collection
        $collection = array();

        // Loop through each element of the form


        foreach ($errors as $error) {
            if ($error->getPropertyPath() == 'children[plainPassword]') {
                $collection[str_replace("children[plainPassword]", "secondPassword", $error->getPropertyPath())] = $error->getMessage();
            } else {
                $collection[str_replace("data.", "", $error->getPropertyPath())] = $error->getMessage();
            }
        }
        return $collection;
    }
}