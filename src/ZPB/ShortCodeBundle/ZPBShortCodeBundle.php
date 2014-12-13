<?php

namespace ZPB\ShortCodeBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use ZPB\ShortCodeBundle\DependencyInjection\Compiler\ShortCodePass;

class ZPBShortCodeBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ShortCodePass());
    }
}
