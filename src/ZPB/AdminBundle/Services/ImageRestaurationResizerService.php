<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 03/12/2014
 * Time: 09:41
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

class ImageRestaurationResizerService {

    /**
     * @var \Symfony\Component\Filesystem\Filesystem
     */
    private $fs;
    /**
     * @var array
     */
    private $dims = [];

    public function __construct($dims = [], Filesystem $fs)
    {
        $this->dims = $dims;
        $this->fs = $fs;
    }

    public function makeImage($rootDir, $file, $baseDir, $webDir)
    {
        if(!array_key_exists("regular", $this->dims)){
            return null;
        }

        $destDir = $webDir;
        if(!$this->fs->exists($destDir)){
            $this->fs->mkdir($destDir);
        }
        return $this->resize($rootDir, $file, $destDir, $baseDir, $this->dims["regular"]["width"], $this->dims["regular"]["height"]);
    }

    public function makeThumb($rootDir, $file, $baseDir, $webDir)
    {
        if(!array_key_exists("thumb", $this->dims)){
            return null;
        }

        $destDir = $webDir . "thumb/";
        if(!$this->fs->exists($destDir)){
            $this->fs->mkdir($destDir);
        }
        return $this->resize($rootDir, $file, $destDir, $baseDir, $this->dims["thumb"]["width"], $this->dims["thumb"]["height"]);
    }

    public function resize($rootDir, $file, $destDir, $baseDir, $width, $height)
    {
        $size = getimagesize($rootDir . $file);

        if($size[0] >= $size[1]){
            return $this->landscape($rootDir, $file, $destDir, $baseDir, $width, $height, $size[0], $size[1]);
        } else {
            return $this->portrait($rootDir, $file, $destDir, $baseDir, $width, $height, $size[0], $size[1]);
        }

    }

    private function landscape($rootDir, $file, $destDir, $baseDir, $width, $height, $iniW, $iniH)
    {
        $tmpFile = $rootDir . $file;
        $dest = $baseDir . $destDir . $file;
        $mime = $this->getMimeType($tmpFile);
        $image = $this->createImage($tmpFile, $mime);
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
        return "/" . $destDir . $file;
    }

    private function portrait($rootDir, $file, $destDir, $baseDir, $width, $height, $iniW, $iniH)
    {
        $tmpFile = $rootDir . $file;
        $dest = $baseDir . $destDir . $file;
        $mime = $this->getMimeType($tmpFile);
        $image = $this->createImage($tmpFile, $mime);
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
        return "/" . $destDir . $file;
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
