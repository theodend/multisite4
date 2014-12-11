<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 11/12/2014
 * Time: 17:01
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
use ZPB\AdminBundle\Entity\FAQ;
use ZPB\AdminBundle\Form\Type\FAQType;
use ZPB\Sites\CommonBundle\Controller\ZPBController;

class FAQController extends ZPBController
{
    public function indexAction()
    {
        $faqs = $this->getRepo("ZPBAdminBundle:FAQ")->getAll();
        $newFaqForm = $this->createForm(new FAQType(),new FAQ(), ["em"=>$this->getManager()] );
        return $this->render('ZPBAdminBundle:FAQ:index.html.twig', ["faqs"=>$faqs, "form"=>$newFaqForm->createView()]);
    }

    public function xhrCreateAction(Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $response = ["error"=>true, "msg"=>"", "datas"=>[]];
        $faq = new FAQ();
        $newFaqForm = $this->createForm(new FAQType(),$faq, ["em"=>$this->getManager()] );

        $newFaqForm->handleRequest($request);
        if($newFaqForm->isValid()){
            $this->getManager()->persist($faq);
            $this->getManager()->flush();
            $response["error"] = false;
            $response["datas"] = $faq;
            $response["msg"] = "Nouvelle faq créée.";
        } else {
            // TODO display errors messages
            $response["datas"] = $this->getFormErrors($newFaqForm);
            $response["msg"] = "Il y a des erreurs.";
        }


    }

    public function xhrUpdateAction(Request $request)
    {
        // TODO inject datas in for, save faq, display errors
        if(!$request->isMethod("PUT") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $token = $request->query->get('_token', false);
        if(!$this->validateToken($token, 'update_faq')){
            throw $this->createAccessDeniedException();
        }
        $id = $request->query->get("id", false);
        if(!$id){
            throw $this->createAccessDeniedException();
        }
        $faq = $this->getRepo("ZPBAdminBundle:FAQ")->find($id);
        if(!$faq){
            throw $this->createNotFoundException();
        }
        $response = ["error"=>true, "msg"=>"", "datas"=>[]];

        $updateFaqForm = $this->createForm(new FAQType(),$faq, ["em"=>$this->getManager()] );
        $updateFaqForm->handleRequest($request);
        if($updateFaqForm->isValid()){


            $response["error"] = false;
            $response["datas"] = $faq;
            $response["msg"] = "Faq mise à jour.";
        } else {
            $response["datas"] = $this->getFormErrors($updateFaqForm);
            $response["msg"] = "Il y a des erreurs.";
        }
        return new JsonResponse($response);
    }

    public function xhrDeleteAction(Request $request)
    {
        // TODO javascript delete
        if(!$request->isMethod("DELETE") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $token = $request->query->get('_token', false);
        if(!$this->validateToken($token, 'delete_faq')){
            throw $this->createAccessDeniedException();
        }
        $id = $request->query->get("id", false);
        if(!$id){
            throw $this->createAccessDeniedException();
        }
        $faq = $this->getRepo("ZPBAdminBundle:FAQ")->find($id);
        if(!$faq){
            throw $this->createNotFoundException();
        }
        $response = ["error"=>true, "msg"=>"", "datas"=>[]];
        $this->getManager()->remove($faq);
        $this->getManager()->flush();
        $response["error"] = false;
        $response["datas"] = $faq;
        $response["msg"] = "Faqsupprimée.";

        return new JsonResponse($response);

    }
}
