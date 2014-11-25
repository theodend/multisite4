<?php

namespace ZPB\Sites\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ZPBSitesCommonBundle:Default:index.html.twig', array('name' => $name));
    }
}
