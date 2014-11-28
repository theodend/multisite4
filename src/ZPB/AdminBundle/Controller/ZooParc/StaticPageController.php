<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 28/11/2014
 * Time: 11:23
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

namespace ZPB\AdminBundle\Controller\ZooParc;


use ZPB\Sites\CommonBundle\Controller\ZPBController;

class StaticPageController extends ZPBController
{
    public function indexAction()
    {
        $pages = $this->getRepo('ZPBAdminBundle:Page')->findBy([], ['name'=>'ASC']);
        return $this->render('ZPBAdminBundle:ZooParc/StaticPage:index.html.twig', ['pages'=>$pages]);
    }
} 
