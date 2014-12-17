<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 17/12/2014
 * Time: 10:00
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

namespace ZPB\AdminBundle\Services;


use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use ZPB\AdminBundle\Entity\PressRelease;

class PressReleaseManagerService {

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var EntityManager
     */
    private $em;

    private $options = [];

    private $errors = null;

    public function __construct(ContainerInterface $container, EntityManager $em, $options = [])
    {
        $this->container = $container;
        $this->em = $em;
        $this->options = $options;
    }

    public function createFormHandle(Form $form, Request $request)
    {
        if(!$request->isMethod("POST")){
            return false;
        }

        $form->handleRequest($request);

        if($form->isValid()){
            $this->create($form->getData());
            return true;
        }
        $this->errors = $this->getErrors($form);
        return false;
    }

    public function create($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function getFormErrors()
    {
        return $this->errors;
    }

    protected function getErrors($form)
    {
        $errors = [];
        if ($form instanceof Form) {
            foreach ($form->getErrors() as $error) {

                $errors[] = $error->getMessage();
            }

            foreach ($form->all() as $key => $child) {
                /** @var $child Form */
                if ($err = $this->getErrors($child)) {
                    $errors[$key] = $err;
                }
            }
        }
        return $errors;

    }

    public function xhrUploadImage(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            return [];
        }
        $response = ["msg"=>"","error"=>true,"datas"=>[]];

        $filename = $request->headers->get("X-File-Name", false);
        if(!$filename){
            $response["msg"] = "Données incomplètes.";
        } else{
            if(preg_match('/^.+\.(jpg|jpeg|png|gif)$/i', $filename, $matches)){
                $baseDir = $this->options["image"]["root_dir"] . $this->options["image"]["web_dir"];
                $fs = $this->container->get("filesystem");
                if(!$fs->exists($baseDir)){
                    $fs->mkdir($baseDir);
                }
                $fullPath = $baseDir . "/" . $filename;
                if(false !== file_put_contents($fullPath, $request->getContent())){
                    $resize = $this->resize($fullPath, $this->options["image"]["width"], $this->options["image"]["height"]);
                    if($resize){
                        $response["error"] = false;
                        $response["msg"] = "Image uploadée";
                        $response["datas"] = $this->options["image"]["web_dir"] . "/" . $filename;
                    } else {
                        $response["msg"] = "Problème, image non redimensionnée.";
                    }
                } else {
                    $response["msg"] = "Problème, image non enregistrée.";
                }
            } else {
                $response["msg"] = "Données incorrectes.";
            }
        }

        return $response;
    }

    public function delete(PressRelease $pr)
    {

    }

    public function resize($filename = "", $width = 300, $height = 200)
    {
        if($filename == ""){
            return false;
        }
        $im = new \Imagick();
        try{
            $im->readImage($filename);
        } catch (\ImagickDrawException $ie){
            return false;
        }

        $result = $im->resizeImage($width, $height, \Imagick::FILTER_LANCZOS, 1, true);

        if($result && true === $im->writeImage()){
            $im->destroy();
            return true;
        }
        $im->destroy();
        return false;
    }

}
