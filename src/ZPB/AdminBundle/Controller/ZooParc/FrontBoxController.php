<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 06/12/2014
 * Time: 09:54
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
use ZPB\AdminBundle\Entity\FrontBox;
use ZPB\Sites\CommonBundle\Controller\ZPBController;

class FrontBoxController extends ZPBController
{
    public function indexAction()
    {
        $frontboxs = $this->getRepo("ZPBAdminBundle:FrontBox")->findBy(["site"=>"zoo"], ["position"=>"ASC"]);
        $colors = $this->container->getParameter("zpb.frontbox.colors");
        return $this->render('ZPBAdminBundle:ZooParc/FrontBox:index.html.twig', ["frontboxs"=>$frontboxs, "colors"=>$colors]);
    }

    public function xhrUpdateFrontBoxAction(Request $request)
    {
        // TODO[Nicolas] update front box
        if(!$request->isMethod("PUT") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ["error"=>true, "msg"=>"", "datas"=> []];

        return new JsonResponse($response);
    }

    public function xhrCreateFrontBoxAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ["error"=>true, "msg"=>"", "datas"=> []];
        $title = $request->request->get("title", false);
        $subtitle = $request->request->get("subtitle", false);
        $link = $request->request->get("link", false);
        $image = $request->request->get("image", false);
        $rootDir = $request->request->get("rootDir", false);
        $color = $request->request->get("color", false);

        if(
            !$title ||
            !$subtitle ||
            !$link ||
            !$image ||
            !$rootDir ||
            !$color
        ){
            $response["msg"] = "Données incomplètes.";
        } else {
            $fb = new FrontBox();
            $fb->setRootDir($rootDir)
                ->setImage($image)
                ->setColor($color)
                ->setLink($link)
                ->setTitle($title)
                ->setSubtitle($subtitle)
                ->setSite("zoo");
            $this->getManager()->persist($fb);
            $this->getManager()->flush();

            $response["error"] = false;
            $response["msg"] = "Front box enregistrée";
            $response["datas"] = $fb;
        }

        return new JsonResponse($response);
    }

    public function xhrImageUploadAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $filename = $request->headers->get("X-File-Name", false);
        $response = ["error"=>true, "msg"=>"", "datas"=> []];
        if(!$filename){
            $response["msg"] = "Données incomplètes.";
        } else {
            $fs = $this->get('filesystem');
            $rootDir = $this->container->getParameter('zpb.frontbox.zoo.img_base_dir');
            $webDir = $this->container->getParameter('zpb.frontbox.zoo.img_web_dir');
            $baseDir = $rootDir . $webDir;
            if(!$fs->exists($baseDir)){
                $fs->mkdir($baseDir);
            }
            $webDir = "/" . $webDir;
            $matches = [];
            $extension = '';
            if(preg_match('/^.+\.(jpg|jpeg|png|gif)$/i', $filename, $matches)){
                $extension = strtolower($matches[1]);
                $newFilename = time() . '.' .$extension;
                file_put_contents($baseDir . "/" . $newFilename, $request->getContent());
                $response['error'] = false;
                $response['datas'] = ["img"=>["image"=> $webDir . "/" . $newFilename,"rootDir"=> rtrim($rootDir, "/")]];
                $response['msg'] = 'Image uploadée';
            } else {
                $response["msg"] = "Données incorrectes.";
            }
        }

        return new JsonResponse($response);
    }

    public function xhrDeleteFrontBoxAction(Request $request)
    {
        if(!$request->isMethod("DELETE") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }

        $response = ["error"=>true, "msg"=>"", "datas"=> []];
        $datas = $this->getInput($request);
        if(empty($datas["id"])){
            $response["msg"] = "Données incomplètes.";
        } else {
            $id = intval($datas["id"]);
            /** @var \ZPB\AdminBundle\Entity\FrontBox $box */
            $box = $this->getRepo("ZPBAdminBundle:FrontBox")->find($id);
            if(!$box){
                $response["msg"] = "Données incomplètes.";
            } else {
                $fs = $this->get("filesystem");
                $baseDir = $this->container->getParameter("zpb.frontbox.zoo.img_base_dir");
                $img = $baseDir . trim($box->getImage(), "/");
                if($fs->exists($img)){
                    $fs->remove($img);
                }
                $this->getManager()->remove($box);
                $this->getManager()->flush();
                $response["error"] = false;
                $response["msg"] = "Front box supprimée.";

                $response["datas"] = $box;
            }
        }
        return new JsonResponse($response);
    }

    public function xhrUpdateFrontBoxPositionAction(Request $request)
    {
        if(!$request->isMethod("PUT") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }

        $response = ["error"=>true, "msg"=>"", "datas"=> []];

        $datas = $this->getInput($request);

        if(empty($datas["id"]) || !array_key_exists("position", $datas)){
            $response["msg"] = "Données incomplètes.";
        } else {
            $id = intval($datas["id"]);
            /** @var \ZPB\AdminBundle\Entity\FrontBox $box */
            $box = $this->getRepo("ZPBAdminBundle:FrontBox")->find($id);
            if(!$box){
                $response["msg"] = "Données incomplètes.";
            } else {
                $box->setPosition(intval($datas["position"]));
                $this->getManager()->persist($box);
                $this->getManager()->flush();
                $response["error"] = false;
                $response["msg"] = "Position mise à jour.";

                $response["datas"] = $box;
            }
        }

        return new JsonResponse($response);

    }
}
