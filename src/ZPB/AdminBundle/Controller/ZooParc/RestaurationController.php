<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 30/11/2014
 * Time: 20:31
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
use ZPB\AdminBundle\Entity\Restaurant;

class RestaurationController extends BaseController
{
    public function indexAction()
    {
        $restaurants = $this->getRepo("ZPBAdminBundle:Restaurant")->findBy([], ["name"=>"ASC"]);
        return $this->render('ZPBAdminBundle:ZooParc/Restauration:index.html.twig', ["restaurants"=>$restaurants]);
    }

    public function xhrChangeStatusAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }

        $id = $request->request->get("id", false);

        if($id === false){
            $response["msg"] = "Données incomplètes.";
        } else {
            /** @var \ZPB\AdminBundle\Entity\Restaurant $restaurant */
            $restaurant = $this->getRepo("ZPBAdminBundle:Restaurant")->find($id);
            if(!$restaurant){
                $response["msg"] = "Données incomplètes.";
            } else {
                $restaurant->setIsOpen(!$restaurant->getIsOpen());
                $this->getManager()->persist($restaurant);
                $this->getManager()->flush();
                $response['error'] = false;
                $response['datas'] = $restaurant;
                $response['msg'] = 'Restaurant modifié.';
            }
        }

        $response = ["error"=>true, "msg"=>"", "datas"=>[]];

        return new JsonResponse($response);
    }

    public function xhrCreateRestaurantAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }

        $response = ["error"=>true, "msg"=>"", "datas"=>[]];

        $image = $request->request->get("image", false);
        $thumb = $request->request->get("thumb", false);
        $name = $request->request->get("name", false);
        $description = $request->request->get("description", false);
        $num = $request->request->get("num", false);

        if(!$image || !$thumb || !$name || !$description || !$num){
            $response["msg"] = "Données incomplètes.";
        } else {
            /** @var \ZPB\AdminBundle\Entity\Restaurant $restaurant */
            $restaurant = new Restaurant();
            $restaurant
                ->setImageRoot($this->container->getParameter('zpb.restauration.zoo.img_base_dir'))
                ->setName($name)
                ->setImage($image)
                ->setThumb($thumb)
                ->setDescription($description)
                ->setNum(intval($num));
            $this->getManager()->persist($restaurant);
            $this->getManager()->flush();
            $response['error'] = false;
            $response['datas'] = [];
            $response['msg'] = 'Restaurant créé.';
        }

        return new JsonResponse($response);
    }

    public function xhrImageUploadAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $filename = $request->headers->get("X-File-Name", false);

        $response = ["error"=>true, "msg"=>"", "datas"=>[]];
        if(!$filename){
            $response["msg"] = "Données incomplètes.";
        } else{
            $fs = $this->get('filesystem');
            $baseDir = $this->container->getParameter('zpb.restauration.zoo.img_base_dir');
            $webDir = $this->container->getParameter('zpb.restauration.zoo.img_web_dir');
            $rootDir = $baseDir . $webDir . "tmp/";
            if(!$fs->exists($rootDir)){
                $fs->mkdir($rootDir);
            }
            $matches = [];
            $extension = '';
            if(preg_match('/^.+\.(jpg|jpeg|png|gif)$/i', $filename, $matches)) {
                $extension = strtolower($matches[1]);
                $newFilename = time() . '.' . $extension;
                file_put_contents($rootDir . $newFilename, $request->getContent());
                $resizer = $this->get('zpb.admin.image_restauration_resizer');

                $image = $resizer->makeImage($rootDir, $newFilename, $baseDir, $webDir);
                $thumb = $resizer->makeThumb($rootDir,  $newFilename, $baseDir, $webDir);

                $fs->remove($rootDir . $newFilename);

                if($image === null || $thumb === null ){
                    $response['msg'] = "Problème, image non enregistée.";
                } else {
                    $response['error'] = false;
                    $response['datas'] = ["image"=>$image, "thumb"=>$thumb];
                    $response['msg'] = 'Image uploadée. Images créées.';
                }



            } else {
                $response["msg"] = "Données incorrectes.";
            }

        }
        return new JsonResponse($response);
    }
}
