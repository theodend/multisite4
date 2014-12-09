<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 09/12/2014
 * Time: 16:30
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

namespace ZPB\AdminBundle\Controller\Animal;


use ZPB\Sites\CommonBundle\Controller\ZPBController;

class SpeciesController extends ZPBController
{
    public function indexAction()
    {
        return $this->render('ZPBAdminBundle:Animal/Species:index.html.twig', []);
    }
} 
