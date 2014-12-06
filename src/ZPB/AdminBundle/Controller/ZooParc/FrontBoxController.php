<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 06/12/2014
 * Time: 09:54
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

class FrontBoxController extends ZPBController
{
    public function indexAction()
    {
        return $this->render('ZPBAdminBundle:ZooParc/FrontBox:index.html.twig', []);
    }
}
