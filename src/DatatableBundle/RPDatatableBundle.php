<?php

namespace RP\DatatableBundle;

use RP\DatatableBundle\DependencyInjection\Compiler\AddDatatableConfigsCompilerPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use RP\DatatableBundle\DependencyInjection\Compiler\OverrideServiceCompilerPass;

class RPDatatableBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new OverrideServiceCompilerPass());
        $container->addCompilerPass(new AddDatatableConfigsCompilerPass());
    }

    public function getParent()
    {
        return 'AliDatatableBundle';
    }
}
