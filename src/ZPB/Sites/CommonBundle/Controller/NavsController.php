<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 26/11/2014
 * Time: 00:37
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

namespace ZPB\Sites\CommonBundle\Controller;


class NavsController extends ZPBController
{
    public function topBarAction($active_site)
    {
        return $this->render('ZPBSitesCommonBundle:Navs:topBar.html.twig', ['active'=>$active_site]);
    }
}
