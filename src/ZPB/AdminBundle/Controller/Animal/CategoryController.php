<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 09/12/2014
 * Time: 16:33
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

namespace ZPB\AdminBundle\Controller\Animal;


use Symfony\Component\HttpFoundation\Request;
use ZPB\Sites\CommonBundle\Controller\ZPBController;

class CategoryController extends ZPBController
{
    public function indexAction()
    {
        $cats = $this->getRepo("ZPBAdminBundle:AnimalCategory")->findBy([], ["name"=>"ASC"]);
        return $this->render('ZPBAdminBundle:Animal/Category:index.html.twig', ["cats"=>$cats]);
    }

    public function xhrCreateAction(Request $request)
    {

    }

    public function xhrUpdateAction(Request $request)
    {

    }

    public function xhrDeleteAction(Request $request)
    {

    }

} 
