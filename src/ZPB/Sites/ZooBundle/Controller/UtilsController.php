<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 27/11/2014
 * Time: 16:25
 */
  /*
           ____________________
  __      /     ______         \
 {  \ ___/___ /       }         \
  {  /       / #      }          |
   {/ ô ô  ;       __}           |
   /          \__}    /  \       /\
<=(_    __<==/  |    /\___\     |  \
   (_ _(    |   |   |  |   |   /    #
    (_ (_   |   |   |  |   |   |
      (__<  |mm_|mm_|  |mm_|mm_|
*/

namespace ZPB\Sites\ZooBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use ZPB\Sites\CommonBundle\Controller\ZPBController;

class UtilsController extends ZPBController
{
    public function accessAction(Request $request)
    {
        return $this->getView('ZPBSitesZooBundle:Utils:access.html.twig', $request);
    }

    public function schedulesAndPricesAction(Request $request)
    {
        return $this->getView('ZPBSitesZooBundle:Utils:horaires_tarifs.html.twig', $request);
    }

    public function animationsAndShowsAction(Request $request)
    {
        return $this->getView('ZPBSitesZooBundle:Utils:animations_shows.html.twig', $request);
    }
} 
