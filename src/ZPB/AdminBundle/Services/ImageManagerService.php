<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 13/12/2014
 * Time: 16:48
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
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Entity\Image;

class ImageManagerService {
    /**
     * @var \Symfony\Component\Filesystem\Filesystem
     */
    private $fs;


    private $dims = [];
    private $dirs = [];

    public function __construct($dirs = [], $dims = [], Filesystem $fs)
    {
        $this->dims = $dims;
        $this->dirs = $dirs;
        $this->fs = $fs;
    }

    /**
     * @param string $oldFilename
     * @param Request $request
     * @return bool|Image
     */
    public function createImage($oldFilename = "", Request $request = null)
    {
        if($oldFilename == null || $request == null){
            return false;
        }
        if(preg_match('/^.+\.(jpg|jpeg|png|gif)$/i', $oldFilename, $matches)){
            $extension = $matches[1];
            $newFilename = time() . '.' .$extension;
            $fullPath = $this->getFullPath($newFilename);
            if(false !== file_put_contents($fullPath, $request->getContent())){
                $thumbize = $this->makeThumb($fullPath);
                if($thumbize == true){
                    $image = new Image();
                    $image->setFilename($newFilename);
                    $size = getimagesize($fullPath);
                    $image->setWidth($size[0]);
                    $image->setHeight($size[1]);
                    $image->setMime($size["mime"]);
                    $image->setExtension($extension);
                    return $image;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
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

    /**
     * @param string $filename
     * @return string
     */
    public function getWebPath($filename = "")
    {

        if($filename != null && $this->fs->exists($this->getRealFullPath($filename))){
            return $this->dirs["web_dir"] . "/" . $filename;
        }
        return "";

    }

    /**
     * @param string $filename
     * @return string
     */
    public function getThumbPath($filename = "")
    {
        if($filename != null && $this->fs->exists($this->getRealThumbFullPath($filename))){
            return $this->dirs["web_dir"] . $this->dirs["thumb_dir"] . "/" . $filename;
        }
        return "";

    }

    /**
     * @param string $filename
     * @return string
     */
    public function getRealThumbFullPath($filename = "")
    {
        if($filename != null){
            return realpath($this->dirs["root_dir"] . $this->dirs["web_dir"] . $this->dirs["thumb_dir"] . "/" . $filename);
        }
        return "";
    }

    /**
     * @param string $filename
     * @return string
     */
    public function getRealFullPath($filename = "")
    {
        if($filename != null){
            return realpath($this->dirs["root_dir"] . $this->dirs["web_dir"] . "/" . $filename);
        }
        return "";
    }

    /**
     * @param string $filename
     * @return string
     */
    public function getThumbFullPath($filename = "")
    {
        if($filename != null){
            return $this->dirs["root_dir"] . $this->dirs["web_dir"] . $this->dirs["thumb_dir"] . "/" . $filename;
        }
        return "";
    }

    public function getFullPath($filename = "")
    {
        if($filename != null){
            return $this->dirs["root_dir"] . $this->dirs["web_dir"] . "/" . $filename;
        }
        return "";
    }

    public function deleteImage($filename = "")
    {
        if($filename != ""){
            $fullPath = $this->getRealFullPath($filename);
            $thumbPath = $this->getRealThumbFullPath($filename);
            $flag = true;
            if($fullPath != null){
                try{
                    $this->fs->remove($fullPath);
                } catch (IOException $e){
                    $flag = false;
                }
            }
            if($flag){
                if($thumbPath != null){
                    try{
                        $this->fs->remove($thumbPath);
                    } catch (IOException $e){
                        $flag = false;
                    }
                }
            }
            return $flag;
        }
        return false;
    }

    /**
     * @param string $imagePath
     * @return bool
     */
    public function makeThumb($imagePath = "")
    {
        if(!array_key_exists("thumb", $this->dims) || $imagePath == null){
            return false;
        }
        $thumPath = $this->resolveThumbPath();

        if(!$thumPath){
            return false;
        }

        if(!$this->fs->exists($imagePath)){
            return false;
        }

        $filename = pathinfo($imagePath, PATHINFO_BASENAME);

        $im = new \Imagick();

        try{
            $im->readImage($imagePath);
        } catch(\ImagickDrawException $ie){
            return false;
        }

        $im->thumbnailImage($this->dims["thumb"]["width"], $this->dims["thumb"]["height"], true);

        try{
            $im->writeImage($thumPath . "/" . $filename);
        } catch(\ImagickDrawException $ie){
            return false;
        } finally {
            $im->destroy();
        }

        return true;
    }

    /**
     * @return bool|string
     */
    public function resolveThumbPath()
    {
        if(!array_key_exists("root_dir", $this->dirs) || !array_key_exists("web_dir", $this->dirs) || !array_key_exists("thumb_dir", $this->dirs)){
            return false;
        }

        $path = $this->dirs["root_dir"] . $this->dirs["web_dir"] . $this->dirs["thumb_dir"] ;

        if(!$this->fs->exists($path)){
            $this->fs->mkdir($path);
        }

        return $path;
    }
}
