<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 28/11/2014
 * Time: 11:08
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

namespace ZPB\AdminBundle\Controller;


use ZPB\Sites\CommonBundle\Controller\ZPBController;

class NavsController extends ZPBController
{
    public function topMenuAction()
    {
        return $this->render('ZPBAdminBundle:Navs:top_menu.html.twig', []);
    }

    public function sidebarAction()
    {
        return $this->render('ZPBAdminBundle:Navs:sidebar.html.twig', []);
    }
}
