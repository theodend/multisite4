<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 26/11/2014
 * Time: 06:44
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

namespace ZPB\Sites\ZooBundle\Controller\En;


use Symfony\Component\HttpFoundation\Request;
use ZPB\Sites\CommonBundle\Controller\ZPBController;

class IndexController extends ZPBController
{
    public function indexAction(Request $request)
    {
        return $this->render('ZPBSitesZooBundle:En/Index:index.html.twig', ['page'=>$this->getPage($request)]);
    }
}
