<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 02/12/2014
 * Time: 03:39
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

namespace ZPB\AdminBundle\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Entity\Site;
use ZPB\Sites\CommonBundle\Controller\ZPBController;

class SiteController extends ZPBController
{
    public function indexAction()
    {
        $sites = $this->getRepo("ZPBAdminBundle:Site")->findBy([], ["name"=>"ASC"]);
        return $this->render('ZPBAdminBundle:Site:index.html.twig', ["sites"=>$sites]);
    }

    public function xhrDeleteSiteAction(Request $request)
    {
        if(!$request->isMethod("DELETE") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ["error"=>true, "msg"=>"", "datas"=>[]];
        $datas = [];
        parse_str($request->getContent(), $datas);
        if(empty($datas["id"])){
            $response["msg"] = "Données incomplètes.";
        } else {
            $site = $this->getRepo("ZPBAdminBundle:Site")->find(intval($datas["id"]));
            if(!$site){
                $response["msg"] = "Données incorrectes.";
            } else {
                $galleriesToSites = $this->getRepo("ZPBAdminBundle:GalleryToSite")->findBySite($site);
                foreach($galleriesToSites as $g){
                    $this->getManager()->remove($g);
                    $this->getManager()->flush();

                }
                $this->getManager()->remove($site);
                $this->getManager()->flush();
                $response['error'] = false;
                $response['datas'] = $site;
                $response['msg'] = 'Site supprimé.';
            }
        }

        return new JsonResponse($response);
    }

    public function xhrCreateSiteAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }

        $name = $request->request->get("name", false);
        $route = $request->request->get("route", false);
        $shortname = $request->request->get("shortname", false);
        $response = ["error"=>true, "msg"=>"", "datas"=>[]];
        if(!$name || !$route || !$shortname){
            $response["msg"] = "Données incomplètes.";
        } else {
            $site = new Site();
            $site->setName($name)
                ->setShortname($shortname)
                ->setRoute($route)
                ->setUrl($this->generateUrl($route));
            $this->getManager()->persist($site);
            $this->getManager()->flush();
            $response['error'] = false;
            $response['datas'] = $site;
            $response['msg'] = 'Nouveau site enregistré.';

        }
        return new JsonResponse($response);
    }

    public function updateSiteAction($id, Request $request)
    {

    }
}
