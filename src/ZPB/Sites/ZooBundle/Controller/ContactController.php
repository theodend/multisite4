<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 28/11/2014
 * Time: 17:27
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

namespace ZPB\Sites\ZooBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use ZPB\Sites\CommonBundle\Controller\ZPBController;

class ContactController extends ZPBController
{
    public function indexAction(Request $request)
    {
        return $this->getView('ZPBSitesZooBundle:Contact:index.html.twig', $request);
    }
} 
