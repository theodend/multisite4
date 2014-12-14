<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 13/12/2014
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

namespace ZPB\AdminBundle\Controller\Phototheque;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ZPB\Sites\CommonBundle\Controller\ZPBController;

class IndexController extends ZPBController
{
    public function indexAction()
    {
        $images = $this->getRepo("ZPBAdminBundle:Image")->findAll();
        return $this->render('ZPBAdminBundle:Phototheque/Index:index.html.twig', ["images"=>$images]);
    }

    public function xhrUploadImageAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }

        $response = ["error"=>true, "msg"=>"", "datas"=>[]];

        $filename = $request->headers->get("X-File-Name", false);
        if(!$filename){
            $response["msg"] = "Données incomplètes.";
        } else {
            $imgManager = $this->get("zpb.image_manager");

            $image = $imgManager->createImage($filename, $request);

            if($image === false){
                $response["msg"] = "Données incorrectes.";
            } else {
                $this->getManager()->persist($image);
                $this->getManager()->flush();

                $response["error"] = false;
                $response["msg"] = "Image enregistrée";
                $response["datas"] = ["img"=>$image, "src"=>$imgManager->getThumbPath($image->getFilename())];
            }

        }
        return new JsonResponse($response);
    }

    public function xhrUpdateImageAction(Request $request)
    {
        if(!$request->isMethod("PUT") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ["error"=>true, "msg"=>"", "datas"=>[]];
        $datas = [];
        parse_str($request->getContent(), $datas);

        if(empty($datas["id"])){
            $response["msg"] = "Données incomplètes.";
        } else {
            $id = $datas["id"];
            unset($datas["id"]);
            $image = $this->getRepo("ZPBAdminBundle:Image")->find($id);
            if(!$image){
                $response["msg"] = "Données incorrectes.";
            } else {
                foreach($datas as $k=>$v){
                    $method = "set" . ucfirst($k);
                    if(method_exists($image, $method)){
                        $image->$method($v);
                    }
                }
                $imgManager = $this->get("zpb.image_manager");
                $this->getManager()->persist($image);
                $this->getManager()->flush();
                $response["error"] = false;
                $response["msg"] = "Image modifiée";
                $response["datas"] = ["img"=>$image, "src"=>$imgManager->getThumbPath($image->getFilename())];
            }
        }
        return new JsonResponse($response);
    }

    public function xhrDeleteImageAction(Request $request)
    {
        if(!$request->isMethod("PUT") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $token = $request->query->get("_token", false);
        if(!$token || !$this->validateToken($token, "image_delete")){
            throw $this->createAccessDeniedException();
        }
        $response = ["error"=>true, "msg"=>"", "datas"=>[]];
        $datas = [];
        parse_str($request->getContent(), $datas);
        if(empty($datas["id"])){
            $response["msg"] = "Données incomplètes.";
        } else {
            $id = $datas["id"];
            $image = $this->getRepo("ZPBAdminBundle:Image")->find($id);
            if(!$image){
                $response["msg"] = "Données incorrectes.";
            } else {
                $imgManager = $this->get("zpb.image_manager");
                $deleteResult = $imgManager->deleteImage($image->getFilename());
                if($deleteResult){
                    $response["error"] = false;
                    $response["msg"] = "Image supprimée";
                    $response["datas"] = $image;
                    $this->getManager()->remove($image);
                    $this->getManager()->flush();
                } else {
                    $response["msg"] = "Données incorrectes.";
                }
            }
        }
        return new JsonResponse($response);
    }

}
