<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 02/12/2014
 * Time: 03:39
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

class SiteController extends ZPBController
{
    public function indexAction()
    {
        $sites = $this->getRepo("ZPBAdminBundle:Site")->findBy([], ["name"=>"ASC"]);
        return $this->render('ZPBAdminBundle:Site:index.html.twig', []);
    }
}
