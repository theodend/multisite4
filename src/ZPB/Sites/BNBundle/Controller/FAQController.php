<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 08/12/2014
 * Time: 08:57
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

namespace ZPB\Sites\BNBundle\Controller;


use Symfony\Component\HttpFoundation\Request;

class FAQController extends BaseController
{
    public function indexAction(Request $request)
    {
        return $this->getView("ZPBSitesBNBundle:FAQ:index.html.twig", $request);
    }
} 
