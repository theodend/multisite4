<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 13/12/2014
 * Time: 16:33
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

namespace ZPB\AdminBundle\Controller\Phototheque;


use ZPB\Sites\CommonBundle\Controller\ZPBController;

class IndexController extends ZPBController
{
    public function indexAction()
    {
        return $this->render('ZPBAdminBundle:Phototheque/Index:index.html.twig', []);
    }

}
