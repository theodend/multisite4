<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 25/11/2014
 * Time: 16:54
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

class IndexController extends BaseController
{
    public function indexAction(Request $request)
    {
        return $this->getView('ZPBSitesZooBundle:Index:index.html.twig', $request);
    }
}
