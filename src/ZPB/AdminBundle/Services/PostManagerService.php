<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 15/12/2014
 * Time: 12:20
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


use Symfony\Component\DependencyInjection\ContainerInterface;
use ZPB\AdminBundle\Entity\Post;

class PostManagerService
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function cleanUpPost(Post $post)
    {
        $excerpt = $post->getExcerpt();
        if($excerpt){
            $excerpt = strip_tags($excerpt);
            $post->setExcerpt($excerpt);
        }
        return $post;
    }
}
