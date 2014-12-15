<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 15/12/2014
 * Time: 15:50
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


use Symfony\Component\Filesystem\Filesystem;
use ZPB\AdminBundle\Entity\PDF;

class PDFManagerService
{

    /**
     * @var array
     */
    private $options = [];

    /**
     * @var Filesystem
     */
    private $fs;

    public function __construct(Filesystem $fs, $options = [])
    {
        $this->options = $options;
        $this->fs = $fs;
    }

    /**
     * @param PDF $pdf
     * @return bool
     */
    public function upload(PDF $pdf)
    {
        if($pdf->file == null){
            return false;
        }
        $pdf->setExtension($pdf->file->guessExtension());
        $pdf->setMime($pdf->file->getMimeType());
        $dest = $this->getAbsoluteBasePath();
        if($pdf->getFilename() == null){
            $filename = pathinfo($this->sanitizeFilename($pdf->file->getClientOriginalName()), PATHINFO_FILENAME);
            $pdf->setFilename($filename);
        }
        $pdf->file->move($dest, $pdf->getFilename() . "." . $pdf->getExtension());
        $pdf->file = null;
        return true;
    }

    /**
     * @param PDF $pdf
     * @return bool
     */
    public function deletePdf(PDF $pdf)
    {
        $absolutePath = $this->getAbsoluteBasePath() . $pdf->getFilename() . "." . $pdf->getExtension();
        try {
            $this->fs->remove($absolutePath);
        } catch (\IOException $e) {
            return false;
        }
        return true;
    }

    private function getAbsoluteBasePath()
    {
        return $this->options["root_dir"] . $this->options["web_dir"] . "/";
    }

    private function sanitizeFilename($string = "")
    {
        return preg_replace('/[^a-zA-Z0-9._-]/', '', $string);
    }
}
