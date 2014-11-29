<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 29/11/2014
 * Time: 15:49
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
use ZPB\AdminBundle\Entity\HeaderCarousel;
use ZPB\AdminBundle\Entity\HeaderCarouselSlide;

class CarouselController extends BaseController
{
    public function indexAction()
    {
        $carousel = $this->getRepo("ZPBAdminBundle:HeaderCarousel")->findOneBySite($this->defaultSite);
        if(!$carousel){
            $carousel = new HeaderCarousel();
            $carousel->setSite($this->defaultSite);
            $this->getManager()->persist($carousel);
            $this->getManager()->flush();
        }
        $slides = $this->getRepo("ZPBAdminBundle:HeaderCarouselSlide")->findBySlider($carousel);
        return $this->render('ZPBAdminBundle:ZooParc/Carousel:index.html.twig', ['carousel'=>$carousel, 'slides'=>$slides]);
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
                $webPath = $this->container->getParameter('zpb.carousel.zoo.img_web_dir');
                $basePath = $this->container->getParameter('zpb.carousel.zoo.img_base_dir') . $webPath;
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
