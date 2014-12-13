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


use Symfony\Component\Filesystem\Filesystem;

class ImageResizerService {
    /**
     * @var \Symfony\Component\Filesystem\Filesystem
     */
    private $fs;

    private $dims = [];

    public function __construct($dims = [], Filesystem $fs)
    {
        $this->dims = $dims;
        $this->fs = $fs;
    }

    public function makeThumb($root,  $filename, $webDir)
    {
        if(!array_key_exists("thumb", $this->dims)){
            return null;
        }

        //return $this->resize($root, $filename, $webDir, $this->dims["thumb"]["width"], $this->dims["thumb"]["height"], "thumb");
    }
}
