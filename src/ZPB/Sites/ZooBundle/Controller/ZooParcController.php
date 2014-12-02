<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 27/11/2014
 * Time: 23:08
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

class ZooParcController extends BaseController
{
    public function animalsAction(Request $request)
    {
        return $this->getView('ZPBSitesZooBundle:ZooParc:animals.html.twig',$request);
    }
    public function historyAction(Request $request)
    {
        return $this->getView('ZPBSitesZooBundle:ZooParc:history.html.twig',$request);
    }
    public function missionsAction(Request $request)
    {
        return $this->getView('ZPBSitesZooBundle:ZooParc:missions.html.twig',$request);
    }
    public function concernsAction(Request $request)
    {
        return $this->getView('ZPBSitesZooBundle:ZooParc:concerns.html.twig',$request);
    }
    public function galleryAction(Request $request)
    {
        return $this->getView('ZPBSitesZooBundle:ZooParc:gallery.html.twig',$request);
    }










}
