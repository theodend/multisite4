<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 10/12/2014
 * Time: 20:44
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

namespace ZPB\AdminBundle\Controller\Post;


use ZPB\Sites\CommonBundle\Controller\ZPBController;

class TrashPostController extends ZPBController
{
    public function indexAction()
    {
        $posts = $this->getRepo("ZPBAdminBundle:TrashPost")->getPosts();
        return $this->render('ZPBAdminBundle:Post/TrashPost:index.html.twig', ["posts"=>$posts]);
    }
}
