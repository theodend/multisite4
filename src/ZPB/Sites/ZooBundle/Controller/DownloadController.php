<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 16/12/2014
 * Time: 16:14
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

namespace ZPB\Sites\ZooBundle\Controller;


use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use ZPB\AdminBundle\Entity\PdfStat;

class DownloadController extends BaseController
{
    public function donwloadPdfAction($filename, $_format, Request $request)
    {
        $filename = str_replace('.'.$_format, '', $filename);
        /** @var \ZPB\AdminBundle\Entity\PDF $pdf */
        $pdf = $this->getRepo('ZPBAdminBundle:PDF')->findOneByFilename($filename);
        $pdfManager = $this->get("zpb.pdf_manager");
        $absolutePath = $pdfManager->getAbsoluteBasePath() . $filename;
        if(!$pdf || !file_exists($absolutePath)){
            throw $this->createNotFoundException();
        }
        $stat = new PdfStat();
        $stat
            ->setFilename($filename)
            ->setPdfId($pdf->getId())
            ->setSite($this->site);
        $this->getManager()->persist($stat);
        $this->getManager()->flush();
        $response = new BinaryFileResponse($absolutePath);
        $response->setContentDisposition( ResponseHeaderBag::DISPOSITION_ATTACHMENT, $pdf->getFilename() . '.' .$pdf->getExtension());
        return $response;
    }
}
