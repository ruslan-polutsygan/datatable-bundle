<?php

namespace RP\DatatableBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class AddDatatableConfigsCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $configs = $container->findTaggedServiceIds('datatable.config');
        $factory = $container->getDefinition('datatable.registry');
        foreach ($configs as $serviceId => $tag) {
            $factory->addMethodCall('addConfig', [new Reference($serviceId)]);
        }
    }
}
