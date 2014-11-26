<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 25/11/2014
 * Time: 16:54
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


use Symfony\Component\BrowserKit\Request;
use ZPB\Sites\CommonBundle\Controller\ZPBController;

class IndexController extends ZPBController
{
    public function index(Request $request)
    {
        $page = $this->getPage($request);

        return $this->render('ZPBSitesZooBundle:Index:index.html.twig', ['page'=>$page]);
    }
}
