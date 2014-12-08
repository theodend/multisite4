<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 04/12/2014
 * Time: 16:36
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

namespace ZPB\Sites\ScoBundle\Controller;




use Symfony\Component\HttpFoundation\Request;

class MiscellaneousController extends BaseController
{
    public function legalsAction(Request $request)
    {
        return $this->getView("ZPBSitesScoBundle:Miscellaneous:legals.html.twig",$request);
    }

    public function cgvAction(Request $request)
    {
        return $this->getView("ZPBSitesScoBundle:Miscellaneous:cgv.html.twig", $request);
    }
} 
