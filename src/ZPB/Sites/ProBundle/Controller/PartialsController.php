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

namespace ZPB\Sites\ProBundle\Controller;



class PartialsController extends BaseController
{
    public function mainFooterAction()
    {
        return $this->getView('ZPBSitesProBundle:Partials:main_footer.html.twig');
    }

    public function mainMobileFooterAction()
    {
        return $this->getView('ZPBSitesProBundle:Partials:main_mobile_footer.html.twig');
    }
}
