<?php

namespace Zimt\WebBundle\Controller;

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
    	return array();
    }
    
}
