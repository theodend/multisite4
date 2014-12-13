<?php

namespace ZPB\ShortCodeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ZPBShortCodeBundle:Default:index.html.twig', array('name' => $name));
    }
}
