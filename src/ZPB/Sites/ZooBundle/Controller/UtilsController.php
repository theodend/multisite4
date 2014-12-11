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

        $result = $this->getRepo("ZPBAdminBundle:Restaurant")->findAllToArray();
        $restoRows = array_chunk($result, 3);
        return $this->getView('ZPBSitesZooBundle:Utils:restos.html.twig', $request, ["restoRows"=>$restoRows]);
    }

    public function servicesAction(Request $request)
    {
        $services = file_get_contents($this->get("kernel")->getRootDir()."/../web/mds/services.md");
        return $this->getView('ZPBSitesZooBundle:Utils:services.html.twig', $request, ["services"=>$services]);
    }
}
