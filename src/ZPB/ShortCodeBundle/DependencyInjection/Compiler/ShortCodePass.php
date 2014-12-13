<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 13/12/2014
 * Time: 10:06
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

namespace ZPB\ShortCodeBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ShortCodePass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        if(!$container->hasDefinition("zpb.shortcode_helper")){
            return;
        }
        $definition = $container->getDefinition('zpb.shortcode_helper');

        foreach ($container->findTaggedServiceIds('zpb.shortcode') as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $definition->addMethodCall('addShortCode', array($attributes['alias'], new Reference($id)));
            }
        }
    }
}
