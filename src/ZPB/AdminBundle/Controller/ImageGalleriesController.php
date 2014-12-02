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
use ZPB\AdminBundle\Entity\GalleryToSite;
use ZPB\AdminBundle\Entity\ImageGallery;
use ZPB\AdminBundle\Entity\ImageGalleryImage;
use ZPB\Sites\CommonBundle\Controller\ZPBController;

class ImageGalleriesController extends ZPBController
{
    public function indexAction()
    {
        $galleries = $this->getRepo("ZPBAdminBundle:ImageGallery")->findBy([], ["name"=>"ASC"]);
        $sites = $this->getRepo("ZPBAdminBundle:Site")->findBy([], ["name"=>"ASC"]);
        return $this->render('ZPBAdminBundle:ImageGalleries:index.html.twig', ["galleries"=>$galleries, "sites"=>$sites]);
    }

    public function updateAction($id, Request $request)
    {
        $gallery = $this->getRepo("ZPBAdminBundle:ImageGallery")->find($id);
        if(!$gallery){
            throw $this->createNotFoundException();
        }
        $sites = $this->getRepo("ZPBAdminBundle:Site")->findBy([], ["name"=>"ASC"]);
        $shares = $this->getRepo("ZPBAdminBundle:GalleryToSite")->getSitesArray($id);

        return $this->render('ZPBAdminBundle:ImageGalleries:update.html.twig', ["gallery"=>$gallery, "sites"=>$sites, "shares"=>$shares]);
    }

    public function xhrImageUploadAction($id, Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $filename = $request->headers->get("X-File-Name", false);
        $response = ["error"=>true, "msg"=>"", "datas"=>[]];
        if(!$filename){
            $response["msg"] = "Données incomplètes.";
        } else{
            /** @var \ZPB\AdminBundle\Entity\ImageGallery $gallery */
            $gallery = $this->getRepo("ZPBAdminBundle:ImageGallery")->find($id);
            if(!$gallery){
                $response["msg"] = "Données incorrectes.";
            } else {
                $fs = $this->get('filesystem');
                $rootDir = $this->container->getParameter('zpb.image_galleries.base_dir');
                $webDir = $this->container->getParameter('zpb.image_galleries.web_dir');
                if(!$fs->exists($rootDir)){
                    $fs->mkdir($rootDir);
                }
                $matches = [];
                $extension = '';
                if(preg_match('/^.+\.(jpg|jpeg|png|gif)$/i', $filename, $matches)){
                    $extension = strtolower($matches[1]);
                    $newFilename = time() . '.' .$extension;
                    if(!$fs->exists($rootDir . $webDir . $gallery->getSlug())){
                        $fs->mkdir($rootDir . $webDir . $gallery->getSlug());
                    }
                    file_put_contents($rootDir . $webDir . $gallery->getSlug() . "/" . $newFilename, $request->getContent());
                    $resizer = $this->container->get('zpb.admin.image_gallery_resizer');

                    $adminFilename = $resizer->makeAdminThumb($rootDir, $newFilename, $webDir . $gallery->getSlug() . "/");
                    $thumbFilename = $resizer->makeThumb($rootDir, $newFilename, $webDir . $gallery->getSlug() . "/");
                    $slideFilename = $resizer->makeSlide($rootDir, $newFilename, $webDir . $gallery->getSlug() . "/");

                    $img = new ImageGalleryImage();
                    $img->setFilename($newFilename);
                    $img->setWebRoot($webDir . $gallery->getSlug() . "/" . $newFilename)->setRoot($this->container->getParameter('zpb.image_galleries.base_dir'));
                    $img->setGallery($gallery);
                    $img->setAdminThumb($adminFilename)->setSlide($slideFilename)->setThumb($thumbFilename);
                    $this->getManager()->persist($img);
                    $this->getManager()->flush();

                    $response['error'] = false;
                    $response['datas'] = $img;
                    $response['msg'] = 'Image uploadée. Image créé.';
                } else{
                    $response["msg"] = "Données incorrectes.";
                }
            }
        }
        return new JsonResponse($response);
    }

    public function xhrChangeActiveStateAction($id, Request $request)
    {
        if(!$request->isMethod("PUT") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ["error"=>true, "msg"=>"", "datas"=>[]];
        /** @var \ZPB\AdminBundle\Entity\ImageGallery $gallery */
        $gallery = $this->getRepo("ZPBAdminBundle:ImageGallery")->find($id);
        if(!$gallery){
            $response["msg"] = "Données incorrectes.";
        } else {
            $datas = [];
            parse_str($request->getContent(), $datas);
            if(empty($datas["id"])){
                $response["msg"] = "Données incomplètes.";
            } else {
                $id = intval($datas["id"]);
                /** @var \ZPB\AdminBundle\Entity\ImageGalleryImage $img */
                $img = $this->getRepo("ZPBAdminBundle:ImageGalleryImage")->find($id);
                if(!$img){
                    $response["msg"] = "Données incomplètes.";
                } else {
                    $img->setIsActive(!$img->getIsActive());
                    $this->getManager()->persist($img);
                    $this->getManager()->flush();
                    $response['error'] = false;
                    $response['datas'] = $img;
                    $response['msg'] = ($img->getIsActive() == true) ? 'Image activée.' : 'Image désactivée.' ;
                }
            }
        }
        return new JsonResponse($response);
    }

    public function xhrChangePositionAction($id, Request $request)
    {
        if(!$request->isMethod("PUT") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ["error"=>true, "msg"=>"", "datas"=>[]];
        /** @var \ZPB\AdminBundle\Entity\ImageGallery $gallery */
        $gallery = $this->getRepo("ZPBAdminBundle:ImageGallery")->find($id);
        if(!$gallery){
            $response["msg"] = "Données incorrectes.";
        } else {
            $datas = [];
            parse_str($request->getContent(), $datas);
            if(empty($datas["id"]) || !isset($datas["position"])){
                $response["msg"] = "Données incomplètes.";
            } else {
                $img = $this->getRepo("ZPBAdminBundle:ImageGalleryImage")->find(intval($datas["id"]));
                if(!$img){
                    $response["msg"] = "Données incorrectes.";
                } else {
                    $img->setPosition(intval($datas["position"]));
                    $this->getManager()->persist($img);
                    $this->getManager()->flush();
                    $response['error'] = false;
                    $response['datas'] = $img;
                    $response['msg'] = 'Image repositionnée.';
                }
            }
        }
        return new JsonResponse($response);
    }

    public function xhrDeleteImageAction($id, Request $request)
    {
        if(!$request->isMethod("DELETE") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ["error"=>true, "msg"=>"", "datas"=>[]];
        /** @var \ZPB\AdminBundle\Entity\ImageGallery $gallery */
        $gallery = $this->getRepo("ZPBAdminBundle:ImageGallery")->find($id);
        if(!$gallery){
            $response["msg"] = "Données incorrectes.";
        } else {
            $datas = [];
            parse_str($request->getContent(), $datas);
            if(empty($datas["id"])){
                $response["msg"] = "Données incomplètes.";
            } else {
                /** @var \ZPB\AdminBundle\Entity\ImageGalleryImage $img */
                $img = $this->getRepo("ZPBAdminBundle:ImageGalleryImage")->find(intval($datas["id"]));
                if(!$img){
                    $response["msg"] = "Données incorrectes.";
                } else {
                    $fs = $this->container->get('filesystem');
                    if($fs->exists($img->getRoot())){
                        $fs->remove($img->getRoot() . $img->getWebRoot());
                        $fs->remove($img->getRoot() . $img->getAdminThumb());
                        $fs->remove($img->getRoot() . $img->getSlide());
                        $fs->remove($img->getRoot() . $img->getThumb());
                    }
                    $this->getManager()->remove($img);
                    $this->getManager()->flush();
                    $response['error'] = false;
                    $response['datas'] = $img;
                    $response['msg'] = 'Image supprimée.';
                }
            }
        }
        return new JsonResponse($response);
    }

    public function deleteGalleryAction($id, Request $request)
    {
        if(!$request->isMethod("DELETE") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ["error"=>true, "msg"=>"", "datas"=>[]];
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
                $fs->remove($img->getRoot() . $img->getWebRoot());
                $fs->remove($img->getRoot() . $img->getAdminThumb());
                $fs->remove($img->getRoot() . $img->getSlide());
                $fs->remove($img->getRoot() . $img->getThumb());
            }
            $this->getManager()->remove($img);
        }
        $galleryToSite = $this->getRepo("ZPBAdminBundle:GalleryToSite")->findByGallery($gallery);
        foreach($galleryToSite as $g){
            $this->getManager()->remove($g);
            $this->getManager()->flush();
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
        $isHD = $request->request->get("isHD", false);
        $shares = $request->request->get("shares", false);
        if(!$name || !$isPrivate || !$isHD){
            $response["msg"] = "Données incomplètes.";
        } else {
            $gallery = new ImageGallery();
            $gallery->setName($name);
            if($isPrivate == "private"){
                $gallery->setIsPrivate(true);
            } else {
                $gallery->setIsPrivate(false);
            }
            if($isHD == "yes"){
                $gallery->setIsHD(true);
            } else {
                $gallery->setIsHD(false);
            }
            $this->getManager()->persist($gallery);
            $this->getManager()->flush();
            if($shares && is_array($shares)){
                foreach($shares as $site){
                    $galToSite = new GalleryToSite();
                    $galToSite->setGalleryId($gallery->getId());
                    $galToSite->setSiteShortcut($site);
                    $this->getManager()->persist($galToSite);
                }
            }
            $this->getManager()->flush();
            $response["error"] = false;
            $response["msg"] = "Galerie enregistrée.";
            $response["datas"] = $gallery;
        }
        return new JsonResponse($response);
    }
}
