<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 16/12/2014
 * Time: 10:33
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
use ZPB\AdminBundle\Entity\PDF;
use ZPB\AdminBundle\Form\Type\PDFType;
use ZPB\AdminBundle\Form\Type\PDFUpdateType;
use ZPB\Sites\CommonBundle\Controller\ZPBController;

class PDFController extends ZPBController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $pdfs = $this->getRepo("ZPBAdminBundle:PDF")->findAll();
        $pdf = new PDF();
        $form = $this->createForm(new PDFType(), $pdf);
        $form->handleRequest($request);
        if($form->isValid()){
            $pdfManager = $this->get("zpb.pdf_manager");
            $pdfManager->upload($pdf);
            $this->getManager()->persist($pdf);
            $this->getManager()->flush();
            return $this->redirect($this->generateUrl("zpb_admin_pdfs_homepage"));
        }
        return $this->render('ZPBAdminBundle:PDF:index.html.twig', ["pdfs"=>$pdfs, "form"=>$form->createView()]);
    }

    public function editAction($id, Request $request)
    {
        $pdf = $this->getRepo("ZPBAdminBundle:PDF")->find($id);
        if(!$pdf){
            throw $this->createNotFoundException();
        }
        $form = $this->createForm(new PDFUpdateType(), $pdf);
        $form->handleRequest($request);
        if($form->isValid()){
            $this->getManager()->persist($pdf);
            $this->getManager()->flush();
            return $this->redirect($this->generateUrl("zpb_admin_pdfs_homepage"));
        }
        return $this->render('ZPBAdminBundle:PDF:edit.html.twig', ["form"=>$form->createView()]);
    }

    public function xhrDeleteAction(Request $request)
    {
        if(!$request->isMethod("DELETE") || !$request->isXmlHttpRequest()){
            throw $this->createAccessDeniedException();
        }
        $token = $request->query->get("_token", false);
        if(!$this->validateToken($token, "delete_pdf")){
            throw $this->createAccessDeniedException();
        }
        $response = ["error"=>true, "msg"=>"", "datas"=>[]];
        $datas = [];
        parse_str($request->getContent(), $datas);
        $id = (empty($datas["id"])) ? false : $datas["id"];
        if(!$id){
            $response["msg"] = "Données incomplètes.";
        } else {
            $pdf = $this->getRepo("ZPBAdminBundle:PDF")->find(intval($id));
            if(!$pdf){
                $response["msg"] = "Données incomplètes.";
            } else {
                $pdfManager = $this->get("zpb.pdf_manager");
                if($pdfManager->deletePdf($pdf)){
                    $this->getManager()->remove($pdf);
                    $this->getManager()->flush();
                    $response["msg"] = "Pdf supprimé.";
                    $response["error"] = false;
                    $response["datas"] = $pdf;
                } else {
                    $response["msg"] = "Problème, pdf non supprimé.";
                }
            }
        }
        return new JsonResponse($response);
    }
}
