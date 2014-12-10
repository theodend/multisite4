<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 10/12/2014
 * Time: 20:43
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

class DraftPostController extends ZPBController
{
    public function indexAction()
    {
        $posts = $this->getRepo("ZPBAdminBundle:DraftPost")->getPosts();
        return $this->render('ZPBAdminBundle:Post/DraftPost:index.html.twig', ["posts"=>$posts]);
    }
}
