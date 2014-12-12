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
    public function newsAction(Request $request, $page = 1)
    {
        $pagination = $this->getRepo("ZPBAdminBundle:PublishPost")->getPagination($this->site, $page, 2);
        $pagination["posts"] = array_chunk($pagination["posts"], 2);
        return $this->getView('ZPBSitesZooBundle:News:news.html.twig',$request, ["pagination"=>$pagination]);
    }

    public function newsSingleAction($slug, Request $request)
    {
        $post = $this->getRepo("ZPBAdminBundle:PublishPost")->getPostBySlug($slug);
        if(!$post){
            throw $this->createNotFoundException();
        }
        return $this->getView('ZPBSitesZooBundle:News:single_post.html.twig',$request, ["post"=>$post]);
    }

    public function nouveautesAction(Request $request)
    {
        $posts = $this->getRepo("ZPBAdminBundle:PublishPost")->getPostsByCategory("nouveautes");
        return $this->getView('ZPBSitesZooBundle:News:nouveautes.html.twig',$request, ["posts"=>$posts]);
    }
}
