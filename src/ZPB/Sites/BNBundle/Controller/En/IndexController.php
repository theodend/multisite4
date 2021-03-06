<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 08/12/2014
 * Time: 08:43
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

namespace ZPB\Sites\BNBundle\Controller\En;


use Symfony\Component\HttpFoundation\Request;
use ZPB\Sites\BNBundle\Controller\BaseController;

class IndexController extends BaseController
{
    public function indexAction(Request $request)
    {
        return $this->getView("ZPBSitesBNBundle:En/Index:index.html.twig", $request);
    }
} 
