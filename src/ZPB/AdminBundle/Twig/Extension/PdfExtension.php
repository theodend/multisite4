<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 15/12/2014
 * Time: 17:18
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

namespace ZPB\AdminBundle\Twig\Extension;


use ZPB\AdminBundle\Entity\PDF;
use ZPB\AdminBundle\Services\PDFManagerService;

class PdfExtension extends \Twig_Extension
{
    /**
     * @var PdfManagerService
     */
    private $pdfManager;

    public function __construct(PdfManagerService $pdfManager)
    {
        $this->pdfManager = $pdfManager;
    }

    public function getFunctions()
    {
        return[
            new \Twig_SimpleFunction("pdf_web_path", [$this, "getWebPath"], ["is_safe"=>["html"]]),
            new \Twig_SimpleFunction("get_pdf_shortcode", [$this, "getShortcode"], ["is_safe"=>["html"]]),
        ];
    }

    public function getWebPath(PDF $pdf = null)
    {
        if($pdf == null){
            return "";
        }
        return $this->pdfManager->getWebPath($pdf);
    }

    public function getShortcode(PDF $pdf = null)
    {
        if($pdf == null){
            return "";
        }
        $title = ($pdf->getCopyright() != null) ? $pdf->getTitle() . " &copy; " . $pdf->getCopyright() : $pdf->getTitle();
        return '[pdf filename="'.$pdf->getFilename().'" title="'. $title .'" class="" alt=""]'.$pdf->getFilename().'[/pdf]';
    }

    public function getName()
    {
        return "zpb_pdf_extension";
    }
}
