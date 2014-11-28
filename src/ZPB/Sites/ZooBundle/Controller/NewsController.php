<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 28/11/2014
 * Time: 15:55
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

class NewsController extends ZPBController
{
    public function newsAction(Request $request)
    {
        return $this->getView('ZPBSitesZooBundle:News:news.html.twig',$request);
    }

    public function nouveautesAction(Request $request)
    {
        return $this->getView('ZPBSitesZooBundle:News:nouveautes.html.twig',$request);
    }
} 
