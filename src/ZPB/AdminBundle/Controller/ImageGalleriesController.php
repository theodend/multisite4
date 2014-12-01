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

    public function updateAction($id, Request $request)
    {
        $gallery = $this->getRepo("ZPBAdminBundle:ImageGallery")->find($id);
        if(!$gallery){
            throw $this->createNotFoundException();
        }

        return $this->render('ZPBAdminBundle:ImageGalleries:update.html.twig', ["gallery"=>$gallery]);
    }

    public function deleteGalleryAction($id, Request $request)
    {
        if(!$request->isMethod("DELETE") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ["error"=>false, "msg"=>"", "datas"=>[]];
        /** @var \ZPB\AdminBundle\Entity\ImageGallery $gallery */
        $gallery = $this->getRepo("ZPBAdminBundle:ImageGallery")->find($id);
        if(!$gallery){
            throw $this->createNotFoundException();
        }
        $images = $gallery->getImages();
        $fs = $this->container->get('filesystem');
        foreach($images as $img){
            /** @var \ZPB\AdminBundle\Entity\ImageGalleryImage $img */
            if($fs->exists($img->getRoot())){
                $fs->remove($img->getRoot());
            }
            $this->getManager()->remove($img);
        }
        $this->getManager()->remove($gallery);
        $this->getManager()->flush();
        $response["error"] = false;
        $response["msg"] = "Galerie et photos associées effacées.";
        $response["datas"] = $gallery;
        return new JsonResponse($response);
    }

    public function xhrNewGalleryAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ["error"=>true, "msg"=>"", "datas"=>[]];
        $name = $request->request->get("name", false);
        $isPrivate = $request->request->get("isPrivate", false);
        if(!$name || !$isPrivate){
            $response["msg"] = "Données incomplètes.";
        } else {
            $gallery = new ImageGallery();
            $gallery->setName($name);
            if($isPrivate == "private"){
                $gallery->setIsPrivate(true);
            } else {
                $gallery->setIsPrivate(false);
            }
            $this->getManager()->persist($gallery);
            $this->getManager()->flush();
            $response["error"] = false;
            $response["msg"] = "Galerie enregistrée.";
            $response["datas"] = $gallery;
        }
        return new JsonResponse($response);
    }
} 
