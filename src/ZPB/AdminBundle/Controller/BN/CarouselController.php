<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 30/11/2014
 * Time: 16:37
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
use ZPB\AdminBundle\Entity\HeaderCarousel;
use ZPB\AdminBundle\Entity\HeaderCarouselSlide;

class CarouselController extends BaseController
{
    public function indexAction()
    {
        $carousel = $this->getRepo("ZPBAdminBundle:HeaderCarousel")->findOneBy(["site"=>$this->defaultSite]);
        if(!$carousel){
            $carousel = new HeaderCarousel();
            $carousel->setSite($this->defaultSite);
            $this->getManager()->persist($carousel);
            $this->getManager()->flush();
        }
        $slides = $this->getRepo("ZPBAdminBundle:HeaderCarouselSlide")->findBy(["slider"=>$carousel], ["position"=>"ASC"]);
        return $this->render('ZPBAdminBundle:BN/Carousel:index.html.twig', ['carousel'=>$carousel, 'slides'=>$slides]);
    }

    public function xhrCarouselChangeDurationAction($id, Request $request)
    {
        if(!$request->isMethod("PUT") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ["error"=>true, "msg"=>"", "datas"=>[]];
        /** @var $carousel \ZPB\AdminBundle\Entity\HeaderCarousel */
        $carousel = $this->getRepo("ZPBAdminBundle:HeaderCarousel")->find($id);
        if(!$carousel){
            $response["msg"] = "Données incorrectes.";
        } else {
            $datas = [];
            parse_str($request->getContent(), $datas);
            if(empty($datas["duration"])){
                $response["msg"] = "Données incomplètes.";
            } else {
                $carousel->setDuration(intval($datas["duration"]));
                $this->getManager()->persist($carousel);
                $this->getManager()->flush();
                $response['error'] = false;
                $response['datas'] = $carousel;
                $response['msg'] = "Durée modifiée." ;
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
        $carousel = $this->getRepo("ZPBAdminBundle:HeaderCarousel")->find($id);
        if(!$carousel){
            $response["msg"] = "Données incorrectes.";
        } else {
            $datas = [];
            parse_str($request->getContent(), $datas);
            if(empty($datas["id"])){
                $response["msg"] = "Données incomplètes.";
            } else {
                $id = intval($datas["id"]);
                /** @var $slide \ZPB\AdminBundle\Entity\HeaderCarouselSlide */
                $slide = $this->getRepo("ZPBAdminBundle:HeaderCarouselSlide")->find($id);
                if(!$slide){
                    $response["msg"] = "Données incomplètes.";
                } else {
                    $slide->setIsActive(!$slide->getIsActive());
                    $this->getManager()->persist($slide);
                    $this->getManager()->flush();
                    $response['error'] = false;
                    $response['datas'] = $slide;
                    $response['msg'] = ($slide->getIsActive() == true) ? 'Image activée.' : 'Image désactivée.' ;
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
        $carousel = $this->getRepo("ZPBAdminBundle:HeaderCarousel")->find($id);
        if(!$carousel){
            $response["msg"] = "Données incorrectes.";
        } else {
            $datas = [];
            parse_str($request->getContent(), $datas);
            if(empty($datas["id"]) || !isset($datas["position"])){
                $response["msg"] = "Données incomplètes.";
            } else {
                $id = intval($datas["id"]);
                /** @var $slide \ZPB\AdminBundle\Entity\HeaderCarouselSlide */
                $slide = $this->getRepo("ZPBAdminBundle:HeaderCarouselSlide")->find($id);
                if(!$slide){
                    $response["msg"] = "Données incomplètes.";
                } else {
                    $slide->setPosition(intval($datas["position"]));
                    $this->getManager()->persist($slide);
                    $this->getManager()->flush();
                    $response['error'] = false;
                    $response['datas'] = $slide;
                    $response['msg'] = 'Image repositionnée.';
                }
            }
        }

        return new JsonResponse($response);
    }

    public function xhrDeleteSlideAction($id, Request $request)
    {
        if(!$request->isMethod("DELETE") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ["error"=>true, "msg"=>"", "datas"=>[]];
        $carousel = $this->getRepo("ZPBAdminBundle:HeaderCarousel")->find($id);
        if(!$carousel){
            $response["msg"] = "Données incorrectes.";
        } else {
            $datas = [];
            parse_str($request->getContent(), $datas);
            if(empty($datas["id"])){
                $response["msg"] = "Données incomplètes.";
            } else {
                $id = intval($datas["id"]);
                /** @var $slide \ZPB\AdminBundle\Entity\HeaderCarouselSlide */
                $slide = $this->getRepo("ZPBAdminBundle:HeaderCarouselSlide")->find($id);
                if(!$slide){
                    $response["msg"] = "Données incorrectes.";
                } else {
                    $fs = $this->get('filesystem');
                    $fs->remove($slide->getRootDir());
                    $this->getManager()->remove($slide);
                    $this->getManager()->flush();
                    $response['error'] = false;
                    $response['datas'] = $slide;
                    $response['msg'] = 'Image supprimée.';
                }
            }

        }
        return new JsonResponse($response);
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
            /**
             * @var \ZPB\AdminBundle\Entity\HeaderCarousel $carousel
             */
            $carousel = $this->getRepo("ZPBAdminBundle:HeaderCarousel")->find($id);
            if(!$carousel || $carousel->getSite() != $this->defaultSite){
                $response["msg"] = "Données incorrectes.";
            } else {
                $fs = $this->get('filesystem');
                $webPath = $this->container->getParameter('zpb.carousel.bn.img_web_dir');
                $basePath = $this->container->getParameter('zpb.carousel.bn.img_base_dir') . $webPath;
                if(!$fs->exists($basePath)){
                    $fs->mkdir($basePath);
                }
                $matches = [];
                $extension = '';
                if(preg_match('/^.+\.(jpg|jpeg|png|gif)$/i', $filename, $matches)){
                    $extension = strtolower($matches[1]);
                    $newFilename = time() . '.' .$extension;

                    file_put_contents($basePath . $newFilename, $request->getContent());

                    $slide = new HeaderCarouselSlide();
                    $slide->setWebRoot('/' . $webPath . $newFilename)->setRootDir($basePath . $newFilename);
                    $slide->setSlider($carousel);
                    $this->getManager()->persist($slide);
                    $this->getManager()->flush();

                    $response['error'] = false;
                    $response['datas'] = $slide;
                    $response['msg'] = 'Image uploadée. Slide créé.';
                } else{
                    $response["msg"] = "Données incorrectes.";
                }
            }
        }
        return new JsonResponse($response);
    }
}
