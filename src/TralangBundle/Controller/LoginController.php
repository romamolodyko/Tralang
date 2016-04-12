<?php

namespace TralangBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LoginController extends Controller
{
    /**
     * @Route("/admin/login")
     * @Method("GET")
     */
    public function loginAction()
    {
        $helper = $this->get('security.authentication_utils');
        return $this->render('TralangBundle:Auth:login.html.twig', array(
            // last authentication error (if any)
            'error' => $helper->getLastAuthenticationError(),
        ));
    }
    /**
     * This is the route the login form submits to.
     *
     * But, this will never be executed. Symfony will intercept this first
     * and handle the login automatically. See form_login in app/config/security.yml
     *
     * @Route("/admin/login_check", name="admin_login_check")
     */
    public function loginCheckAction()
    {
        throw new \Exception('This should never be reached!');
    }
    /**
     * This is the route the user can use to logout.
     *
     * But, this will never be executed. Symfony will intercept this first
     * and handle the logout automatically. See logout in app/config/security.yml
     *
     * @Route("/admin/logout", name="admin_logout")
     */
    public function logoutAction()
    {
        throw new \Exception('This should never be reached!');
    }
}
