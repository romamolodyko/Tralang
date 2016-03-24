<?php
namespace TralangBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Validator\Constraints\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormRegistry;
use Symfony\Component\HttpFoundation\Response;
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
        $form = $this->createForm(Entity\UserType::class, $user);
        $form->handleRequest($request);
        // 2) handle the submit (will only happen on POST)
        $errors = $this->_getErrors($form);
        if (!$errors) {
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setRoles("ROLE_USER");
            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            //$em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            //return $this->redirectToRoute('homepage');
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
            $collection[str_replace("data.", "", $error->getPropertyPath())] = $error->getMessage();
        }
        return $collection;
    }
}