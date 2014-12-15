<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 10/12/2014
 * Time: 21:35
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

namespace ZPB\AdminBundle\Controller\Post;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Entity\DraftPost;
use ZPB\AdminBundle\Form\Type\PostType;
use ZPB\AdminBundle\Entity\Post;
use ZPB\Sites\CommonBundle\Controller\ZPBController;

class PostController extends ZPBController
{
    public function writeAction()
    {
        $post = new Post();
        $form = $this->createForm(new PostType(), $post);


        return $this->render('ZPBAdminBundle:Post/Post:write.html.twig', ["form"=>$form->createView()]);
    }

    public function xhrSaveDraftAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ["error"=>true, "msg"=>"", "datas"=>[]];

        $post = new Post();
        $form = $this->createForm(new PostType(), $post);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($post);
            $this->getManager()->flush();
            $draft = new DraftPost();
            $draft->setPost($post);
            $this->getManager()->persist($draft);
            $this->getManager()->flush();
            $response["error"] = false;
            $response["datas"] = $draft;
            $response["msg"] = "Brouillon enregistré.";
        } else {
            $response["datas"] = $this->getFormErrors($form);
            $response["msg"] = "Il y a des erreurs.";
        }

        return new JsonResponse($response);
    }

    public function xhrSavePublishAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ["error"=>true, "msg"=>"", "datas"=>[]];
        $post = new Post();
        $form = $this->createForm(new PostType(), $post);
        $form->handleRequest($request);
        if($form->isValid()){
            var_dump($request->request->all());
            die();
        }
        return new JsonResponse($response);
    }
}
