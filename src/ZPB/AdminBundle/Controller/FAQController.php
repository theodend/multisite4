<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 11/12/2014
 * Time: 17:01
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

class FAQController extends ZPBController
{
    public function indexAction()
    {
        $faqs = $this->getRepo("ZPBAdminBundle:FAQ")->getAll();
        return $this->render('ZPBAdminBundle:FAQ:index.html.twig', ["faqs"=>$faqs]);
    }
} 
