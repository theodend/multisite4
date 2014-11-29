<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 29/11/2014
 * Time: 15:49
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



class CarouselController extends BaseController
{
    public function indexAction()
    {
        return $this->render('ZPBAdminBundle:ZooParc/Carousel:index.html.twig', []);
    }
}
