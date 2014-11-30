<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 30/11/2014
 * Time: 20:31
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



class RestaurationController extends BaseController
{
    public function indexAction()
    {
        $restaurants = $this->getRepo("ZPBAdminBundle:Restaurant")->findBy([], ["name"=>"ASC"]);
        return $this->render('ZPBAdminBundle:ZooParc/Restauration:index.html.twig', ["restaurants"=>$restaurants]);
    }
}
