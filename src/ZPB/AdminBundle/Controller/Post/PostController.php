<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 10/12/2014
 * Time: 21:35
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

class PostController extends ZPBController
{
    public function writeAction()
    {
        return $this->render('ZPBAdminBundle:Post/Post:write.html.twig', []);
    }
}
