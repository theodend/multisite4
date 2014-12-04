<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 04/12/2014
 * Time: 17:43
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

class NewsLetterController extends BaseController
{
    public function indexAction(Request $request)
    {
        return $this->getView("ZPBSitesZooBundle:NewsLetter:index.html.twig", $request);
    }

    public function thanksAction(Request $request)
    {
        return $this->getView("ZPBSitesZooBundle:NewsLetter:thanks.html.twig", $request);
    }
} 
