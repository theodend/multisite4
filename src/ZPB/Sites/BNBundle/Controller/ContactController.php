<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 08/12/2014
 * Time: 08:50
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

class ContactController extends BaseController
{
    public function indexAction(Request $request)
    {
        //TODO[Nicolas] contact form
        return $this->getView("ZPBSitesBNBundle:Contact:index.html.twig", $request);
    }
} 
