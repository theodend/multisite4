<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 01/12/2014
 * Time: 23:36
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

class ImageGalleryResizerService
{
    private $dims = [];

    /**
     * @var \Symfony\Component\Filesystem\Filesystem
     */
    private $fs;

    public function __construct($dims = [],Filesystem $fs)
    {
        $this->dims = $dims;
        $this->fs = $fs;
    }

    public function makeThumb($root,  $filename, $webDir)
    {
        if(!array_key_exists("thumb", $this->dims)){
            return null;
        }

        return $this->resize($root, $filename, $webDir, $this->dims["thumb"]["width"], $this->dims["thumb"]["height"], "thumb");
    }

    public function makeSlide($root, $filename, $webDir)
    {
        if(!array_key_exists("slide", $this->dims)){
            return null;
        }

        return $this->resize($root, $filename, $webDir, $this->dims["slide"]["width"], $this->dims["slide"]["height"], "slide");
    }

    public function makeAdminThumb($root, $filename, $webDir)
    {
        if(!array_key_exists("admin", $this->dims)){
            return null;
        }

        return $this->resize($root, $filename, $webDir, $this->dims["admin"]["width"], $this->dims["admin"]["height"], "admin");

    }

    public function resize( $root, $filename, $webDir, $width = 188, $height = 55, $dirname = "admin")
    {
        $size = getimagesize($root . $filename);
        if($size[0] >= $size[1]){
             $this->landscape($root, $filename, $width, $height,$dirname, $size[0], $size[1]);
        } else {
             $this->portrait($root, $filename, $width, $height,$dirname, $size[0], $size[1]);
        }
        return $webDir . $dirname . "/" . $filename;
    }

    public function landscape($root, $filename, $width, $height, $dirname, $iniW, $iniH)
    {
        $destDir = $root . $dirname;
        if(!$this->fs->exists($destDir)){
            $this->fs->mkdir($destDir);
        }
        $dest = $destDir . "/" . $filename;
        $abs = $root . $filename;
        $mime = $this->getMimeType($abs);
        $image = $this->createImage($abs, $mime);
        $redim = imagecreatetruecolor($width, $height);
        $white = imagecolorallocate($redim, 255,255,255);
        imagefill($redim,0,0, $white);
        if($iniW > $width){
            $ratio = $width / $iniW;
            $newHeight = $iniH * $ratio;
            $y = floor(($height - $newHeight)/2);
            imagecopyresampled($redim, $image, 0,$y,0,0, $width, $newHeight, $iniW, $iniH);
        } else {
            $x = floor(($width - $iniW) / 2);
            $y = floor(($height - $iniH) / 2);
            imagecopyresampled($redim, $image, $x,$y,0,0, $width, $height, $iniW, $iniH);
        }

        $this->save($redim, $dest, $mime);
        imagedestroy($redim);
        return $dest;
    }

    public function portrait($root, $filename, $width, $height, $dirname, $iniW, $iniH)
    {
        $destDir = $root . $dirname;
        if(!$this->fs->exists($destDir)){
            $this->fs->mkdir($destDir);
        }
        $dest = $destDir . "/" . $filename;
        $abs = $root . $filename;
        $mime = $this->getMimeType($abs);
        $image = $this->createImage($abs, $mime);
        $redim = imagecreatetruecolor($width, $height);
        $white = imagecolorallocate($redim, 255,255,255);
        imagefill($redim,0,0, $white);
        if($iniH > $height){
            $ratio = $height / $iniH;
            $newWidth  = $iniW * $ratio;
            $x = floor(($width - $newWidth) / 2);
            imagecopyresampled($redim, $image, $x, 0,0,0, $newWidth, $height, $iniW, $iniH);

        } else{
            $x = floor(($width - $iniW) / 2);
            $y = floor(($height - $iniH) / 2);
            imagecopyresampled($redim, $image, $x,$y,0,0, $width, $height, $iniW, $iniH);
        }
        $this->save($redim, $dest, $mime);
        imagedestroy($redim);
        return $dest;
    }

    private function getMimeType($file)
    {
        $fileinfo = new \finfo(FILEINFO_MIME_TYPE);
        return $fileinfo->file($file);
    }

    private function createImage($file, $mime = 'image/jpeg')
    {
        $img = null;
        switch ($mime) {
            case 'image/png':
                $img = imagecreatefrompng($file);
                break;
            case 'image/gif':
                $img = imagecreatefromgif($file);
                break;
            case 'image/jpeg':
                $img = imagecreatefromjpeg($file);
                break;
        }
        return $img;
    }

    private function save($image, $destination, $mime = 'image/jpeg', $quality = 100)
    {
        switch ($mime) {
            case 'image/png':
                imagepng($image, $destination);
                break;
            case 'image/gif':
                imagegif($image, $destination);
                break;
            case 'image/jpeg':
                imagejpeg($image, $destination, $quality);
                break;
        }
    }

}
