<?php

namespace Zimt\WebBundle\Controller;

use Zimt\WebBundle\Entity\User;

use Symfony\Component\Security\Core\SecurityContext;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class UserController extends Controller
{
    /**
     * @Route("/user/")
     * @Template()
     */
    public function indexAction()
    {
    	return array();
    }

    /**
     * @Route("/user/login")
     * @Template()
     */
    public function loginAction()
    {
		$request = $this->getRequest();
		$session = $request->getSession();

		// get the login error if there is one
		if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
			$error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
		} else {
			$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
			$session->remove(SecurityContext::AUTHENTICATION_ERROR);
		}

    	return array(
    			'last_username'=>$session->get(SecurityContext::LAST_USERNAME),
    			'error'=>$error);
    }

    /**
     * @Route("/user/create")
     * @Template()
     */
    public function createAction()
    {
    	return array();
    	$request = $this->getRequest();
    	$factory = $this->get('security.encoder_factory');

    	$user = new User();
    	$encoder = $factory->getEncoder($user);
    	$user->setUsername($request->get('username'));
    	$user->setEmail($request->get('email'));
    	$password = $encoder->encodePassword($request->get('password'), $user->getSalt());
    	$user->setPassword($password);

    	$em = $this->getDoctrine()->getManager();
    	$em->persist($user);
    	$em->flush();
    }

}
