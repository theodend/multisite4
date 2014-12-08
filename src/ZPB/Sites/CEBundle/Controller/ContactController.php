<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 08/12/2014
 * Time: 09:36
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

namespace ZPB\Sites\CEBundle\Controller;



use Symfony\Component\HttpFoundation\Request;

class ContactController extends BaseController
{
    public function indexAction(Request $request)
    {
        //TODO[Nicolas] form contact CE
        return $this->getView("ZPBSitesCEBundle:Contact:index.html.twig", $request);
    }
} 
