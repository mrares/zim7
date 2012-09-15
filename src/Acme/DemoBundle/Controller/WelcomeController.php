<?php

namespace Acme\DemoBundle\Controller;

use Acme\DemoBundle\Entity\Post;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WelcomeController extends Controller
{
    public function indexAction()
    {
    	
    	$post = new Post();
    	$post->setName("mypost");
    	$post->setTitle("new title");
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($post);
    	$em->flush();
    	    	
        /*
         * The action's view can be rendered using render() method
         * or @Template annotation as demonstrated in DemoController.
         *
         */
        return $this->render('AcmeDemoBundle:Welcome:index.html.twig');
    }
}
