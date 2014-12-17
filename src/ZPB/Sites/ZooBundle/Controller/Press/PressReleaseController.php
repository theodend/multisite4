<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 28/11/2014
 * Time: 17:24
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

namespace ZPB\Sites\ZooBundle\Controller\Press;


use Symfony\Component\HttpFoundation\Request;
use ZPB\Sites\ZooBundle\Controller\BaseController;

class PressReleaseController extends BaseController
{
    public function indexAction(Request $request)
    {
        $prs = $this->getRepo("ZPBAdminBundle:PressRelease")->findBy([], ["createdAt"=>"ASC"]);
        return $this->getView("ZPBSitesZooBundle:Press/PressRelease:index.html.twig", $request, ["prs"=>$prs]);
    }
}
