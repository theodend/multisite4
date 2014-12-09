<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 10/12/2014
 * Time: 00:44
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

class ConservationController extends BaseController
{
    public function programsAction(Request $request)
    {
        return $this->getView("ZPBSitesBNBundle:Conservation:programs.html.twig", $request, []);
    }

    public function oldProgramsAction(Request $request)
    {
return $this->getView("ZPBSitesBNBundle:Conservation:old_programs.html.twig", $request, []);
    }
}
