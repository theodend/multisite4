<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 29/11/2014
 * Time: 16:05
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

namespace ZPB\AdminBundle\Controller\BN;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Entity\Page;

class StaticPageController extends BaseController
{
    public function indexAction()
    {
        $pages = $this->getRepo('ZPBAdminBundle:Page')->findBy(['site'=>$this->defaultSite], ['name'=>'ASC']);
        return $this->render('ZPBAdminBundle:BN/StaticPage:index.html.twig', ['pages'=>$pages]);
    }

    public function xhrAddPageAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $datas = [
            "name" => $request->request->get("name", false),
            "title" => $request->request->get("title", false),
            "route" => $request->request->get("route", false),
            "description" => $request->request->get("description", ""),
            "parent" => $request->request->get("parent", null),
            "keywords" => $request->request->get("keywords", ""),
            "site"=> $request->request->get("site", $this->defaultSite),
        ];

        $response = ["error"=>true, "msg"=>"", "datas"=>$datas];
        $router = $this->container->get('router');
        if(!$datas["name"] || !$datas["title"] || !$datas["route"]){
            $response["msg"] = "Données manquantes";
        } elseif(!$router->getRouteCollection()->get($datas["route"])){
            $response["msg"] = "Route inconnue";
        } else {
            $testName = $this->getRepo('ZPBAdminBundle:Page')->hasPageNamed($datas["name"]);
            if($testName>0){
                $response["msg"] = "Une page porte déjà ce nom";
            } else {
                $page = new Page();
                $page->setName($datas["name"])
                    ->setSite($datas["site"])
                    ->setTitle($datas["title"])
                    ->setRoute($datas["route"])
                    ->setUrl($router->generate($datas["route"], [] , false))
                    ->setDescription($datas["description"])->setKeywords($datas["keywords"]);
                if($datas["parent"] != null){
                    $parent = $this->getRepo('ZPBAdminBundle:Page')->find(intval($datas["parent"]));
                    if($parent){
                        $page->setParent($parent);
                    }
                }
                $this->getManager()->persist($page);
                $this->getManager()->flush();
                $response["error"] = false;
                $response["msg"] = "Données bien enregistrées";
                $response["datas"] = $page;
            }
        }

        return new JsonResponse($response);

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
                $response["msg"] = "Données bien enregistrées";
                $response["datas"] = $page;
            }
        }

        return new JsonResponse($response);
    }

    public function xhrDeletePageAction(Request $request)
    {
        if(!$request->isMethod("DELETE") || !$request->isXmlHttpRequest()){
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
                $this->getManager()->remove($page);
                $this->getManager()->flush();
                $response["error"] = false;
                $response["msg"] = "Données bien supprimées";
                $response["datas"] = $page;
            }
        }
        return new JsonResponse($response);
    }



}
