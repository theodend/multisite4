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

class UtilsController extends BaseController
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

    public function mapAction(Request $request)
    {
        return $this->getView('ZPBSitesZooBundle:Utils:map.html.twig', $request);
    }

    public function restosAction(Request $request)
    {
        return $this->getView('ZPBSitesZooBundle:Utils:restos.html.twig', $request);
    }

    public function servicesAction(Request $request)
    {
        return $this->getView('ZPBSitesZooBundle:Utils:services.html.twig', $request);
    }
}
