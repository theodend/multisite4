<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 27/11/2014
 * Time: 16:21
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



class PartialsController extends BaseController
{
    public function mainFooterAction()
    {
        return $this->getView('ZPBSitesZooBundle:Partials:main_footer.html.twig');
    }

    public function frontboxAction()
    {
        $result = $this->getRepo("ZPBAdminBundle:FrontBox")->findAllToArray($this->site);
        $frontBoxs = array_chunk($result, 3);

        return $this->render('ZPBSitesZooBundle:Partials:frontbox.html.twig', ["frontboxs"=>$frontBoxs]);
    }
}
