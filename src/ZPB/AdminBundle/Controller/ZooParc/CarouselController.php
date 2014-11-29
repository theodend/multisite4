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

    public function xhrImageUpload(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }

        $response = ["error"=>true, "msg"=>"", "datas"=>[]];

        return new JsonResponse($response);
    }
}
