<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 05/12/2014
 * Time: 00:36
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


class PartialsController extends BaseController
{
    public function mainFooterAction()
    {
        return $this->getView('ZPBSitesCEBundle:Partials:main_footer.html.twig');
    }
}
