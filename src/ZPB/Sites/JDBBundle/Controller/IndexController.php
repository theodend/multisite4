<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 03/12/2014
 * Time: 17:49
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

namespace ZPB\Sites\JDBBundle\Controller;


use Symfony\Component\HttpFoundation\Request;

class IndexController extends BaseController
{
    public function indexAction(Request $request)
    {

        return $this->getView('ZPBSitesJDBBundle:Index:index.html.twig', $request);
    }
}
