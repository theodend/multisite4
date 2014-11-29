<?php

namespace ZPB\Sites\BNBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ZPBSitesBNBundle:Default:index.html.twig', array('name' => $name));
    }
}
