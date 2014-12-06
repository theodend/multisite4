<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 05/12/2014
 * Time: 16:06
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

class AlertController extends ZPBController
{
    public function indexAction()
    {
        $alert = $this->getRepo("ZPBAdminBundle:Alert")->findOneByTarget("zoo");
        return $this->render('ZPBAdminBundle:ZooParc/Alert:index.html.twig', ["alert"=>$alert]);
    }
}
