<?php

namespace RP\DatatableBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OverrideServiceCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('datatable');
        $definition->setClass('RP\DatatableBundle\Util\Datatable');

//        $definition = $container->getDefinition('datatable.twig.extension');
//        $definition->setClass('MJC\DatatableBundle\Twig\Extension\AliDatatableExtension');
    }
}
