<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 14/12/2014
 * Time: 13:43
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


use ZPB\AdminBundle\Entity\Image;
use ZPB\AdminBundle\Services\ImageManagerService;

class ImageExtension extends \Twig_Extension
{
    /**
     * @var ImageManagerService
     */
    private $imgManager;

    public function __construct(ImageManagerService $imgManager)
    {
        $this->imgManager = $imgManager;
    }

    public function getFunctions()
    {
        return[
            new \Twig_SimpleFunction("thumb", [$this, "getThumb"], ["is_safe"=>["html"]]),
            new \Twig_SimpleFunction("img_web_path", [$this, "getWebPath"], ["is_safe"=>["html"]]),
            new \Twig_SimpleFunction("get_img_shortcode", [$this, "getShortcode"], ["is_safe"=>["html"]]),
        ];
    }

    /**
     * @param string $img
     * @return string
     */
    public function getThumb($img = "")
    {
        return $this->imgManager->getThumbPath($img);
    }

    /**
     * @param string $img
     * @return string
     */
    public function getWebPath($img = "")
    {
        return $this->imgManager->getWebPath($img);
    }

    /**
     * @param Image $image
     * @return string
     */
    public function getShortcode(Image $image = null)
    {
        if(!$image){
            return "";
        }
        $title = ($image->getCopyright() != null) ? $image->getTitle() . " &copy; " . $image->getCopyright() : $image->getTitle();
        return '[img filename="'.$image->getFilename().'" width="'.$image->getWidth().'" height="'.$image->getHeight().'" title="'. $title .'" class="" alt=""]';
    }

    public function getName()
    {
        return "zpb_image_extension";
    }


}
