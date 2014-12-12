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

namespace ZPB\Sites\ZooBundle\Controller;




use Symfony\Component\HttpFoundation\Request;

class MiscellaneousController extends BaseController
{
    public function legalsAction(Request $request)
    {
        return $this->getView("ZPBSitesZooBundle:Miscellaneous:legals.html.twig",$request);
    }

    public function cgvAction(Request $request)
    {
        $cgv = file_get_contents($this->get("kernel")->getRootDir()."/../web/mds/cgv-gp.md");
        return $this->getView("ZPBSitesZooBundle:Miscellaneous:cgv.html.twig", $request, ["cgv"=>$cgv]);
    }

    public function rulesAction(Request $request)
    {
        $rules = file_get_contents($this->get("kernel")->getRootDir()."/../web/mds/internal_rules.md");
        return $this->getView("ZPBSitesZooBundle:Miscellaneous:rules.html.twig", $request, ["rules"=>$rules]);
    }
}
