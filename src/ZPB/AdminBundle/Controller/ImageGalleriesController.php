<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 01/12/2014
 * Time: 09:44
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
use ZPB\AdminBundle\Entity\ImageGallery;
use ZPB\Sites\CommonBundle\Controller\ZPBController;

class ImageGalleriesController extends ZPBController
{
    public function indexAction()
    {
        $galleries = $this->getRepo("ZPBAdminBundle:ImageGallery")->findBy([], ["name"=>"ASC"]);
        return $this->render('ZPBAdminBundle:ImageGalleries:index.html.twig', ["galleries"=>$galleries]);
    }

    public function xhrNewGalleryAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ["error"=>true, "msg"=>"", "datas"=>[]];
        $name = $request->request->get("name", false);
        if(!$name){
            $response["msg"] = "Données incomplètes.";
        } else {
            $gallery = new ImageGallery();
            $gallery->setName($name);
            $this->getManager()->persist($gallery);
            $this->getManager()->flush();
            $response["error"] = false;
            $response["msg"] = "Galerie enregistrée.";
            $response["datas"] = $gallery;
        }
        return new JsonResponse($response);
    }
} 
