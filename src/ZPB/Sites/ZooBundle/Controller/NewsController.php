<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 28/11/2014
 * Time: 15:55
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

class NewsController extends BaseController
{
    public function newsAction(Request $request)
    {
        $posts = $this->getRepo("ZPBAdminBundle:PublishPost")->getPosts();
        return $this->getView('ZPBSitesZooBundle:News:news.html.twig',$request, ["posts"=>$posts]);
    }

    public function nouveautesAction(Request $request)
    {
        return $this->getView('ZPBSitesZooBundle:News:nouveautes.html.twig',$request);
    }
}
