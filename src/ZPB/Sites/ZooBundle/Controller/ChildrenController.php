<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 27/11/2014
 * Time: 23:32
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

class ChildrenController extends BaseController
{
    public function gamePadAction(Request $request)
    {
        return $this->getView('ZPBSitesZooBundle:Children:game_pad.html.twig', $request);
    }

    public function juniorKeeperAction(Request $request)
    {
        return $this->getView('ZPBSitesZooBundle:Children:junior_keeper.html.twig', $request);
    }

    public function childJourneyAction(Request $request)
    {
        return $this->getView('ZPBSitesZooBundle:Children:child_journey.html.twig', $request);
    }
}
