<?php

namespace Zimt\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class StuffController extends Controller
{
    /**
     * @Route("/stuff/")
     * @Template()
     */
    public function indexAction()
    {
    	return array();
    }    
    
}
