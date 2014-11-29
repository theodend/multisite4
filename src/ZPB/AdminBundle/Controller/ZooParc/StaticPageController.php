<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 28/11/2014
 * Time: 11:23
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

namespace ZPB\AdminBundle\Controller\ZooParc;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ZPB\Sites\CommonBundle\Controller\ZPBController;

class StaticPageController extends ZPBController
{
    public function indexAction()
    {
        $pages = $this->getRepo('ZPBAdminBundle:Page')->findBy([], ['name'=>'ASC']);
        return $this->render('ZPBAdminBundle:ZooParc/StaticPage:index.html.twig', ['pages'=>$pages]);
    }

    public function xhrUpdatePageAction(Request $request)
    {
        if(!$request->isMethod("PUT") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        parse_str($request->getContent(), $datas);
        $response = ["error"=>true, "msg"=>"", "datas"=>$datas];
        if(!$datas["id"]){
            $response["msg"] = "Données manquantes";
        } else {
            /** @var \ZPB\AdminBundle\Entity\Page $page */
            $page = $this->getRepo('ZPBAdminBundle:Page')->find($datas["id"]);
            if(!$page){
                $response["msg"] = "Données introuvables";
            } else {
                foreach($datas as $k=>$v){
                    if($k == "parent"){
                        $parent = $page->getParent();
                        if($parent != null && $parent->getId() !== intval($v)){
                            $newParent = $this->getRepo('ZPBAdminBundle:Page')->find(intval($v));
                            if($newParent){
                                $page->setParent($newParent);
                            }
                        }
                    } elseif($k == "route"){
                        $page->setRoute($v);
                        $page->setUrl($this->container->get('router')->generate($datas["route"], [], false));
                    } else {
                        $method = "set" . ucfirst($k);
                        if(method_exists($page, $method)){
                            $page->$method($v);
                        }
                    }
                }
                $this->getManager()->persist($page);
                $this->getManager()->flush();
                $response["error"] = false;
                $response["msg"] = "OK";
                $response["datas"] = $page;
            }
        }

       return new JsonResponse($response);
    }
}
