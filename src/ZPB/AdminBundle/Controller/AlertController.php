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

namespace ZPB\AdminBundle\Controller;


use ZPB\Sites\CommonBundle\Controller\ZPBController;

class AlertController extends ZPBController
{
    public function indexAction()
    {
        return $this->render('ZPBAdminBundle:Alert:index.html.twig', []);
    }
} 
