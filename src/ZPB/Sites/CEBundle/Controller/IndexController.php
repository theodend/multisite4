<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 01/12/2014
 * Time: 00:01
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

namespace ZPB\Sites\CEBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use ZPB\Sites\CommonBundle\Controller\ZPBController;

class IndexController extends ZPBController
{
    public function indexAction(Request $request)
    {
        return $this->getView('ZPBSitesCEBundle:Index:index.html.twig', $request);
    }
}
