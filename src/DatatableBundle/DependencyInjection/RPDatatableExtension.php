<?php

namespace RP\DatatableBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class RPDatatableExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $datatableConfigDefinitions = [];
        foreach ($config['datatables'] as $tableConfig) {
            $datatableConfigDefinition = new Definition();
            $datatableConfigDefinition->setClass('RP\DatatableBundle\Datatable\Config\Config');
            $datatableConfigDefinition->addMethodCall('setId', [$tableConfig['id']]);
            $datatableConfigDefinition->addMethodCall('setEntityName', [$tableConfig['entity']['name']]);
            $datatableConfigDefinition->addMethodCall('setEntityAlias', [$tableConfig['entity']['alias']]);
            $datatableConfigDefinition->addMethodCall('setFields', [$tableConfig['fields']]);
//            if (isset($tableConfig['renderers'])) {
                $datatableConfigDefinition->addMethodCall('setRenderers', [$tableConfig['renderers']]);
//            } else {
//                $datatableConfigDefinition->addMethodCall('setRenderers', [[]]);
//            }
            $datatableConfigDefinition->addMethodCall('setWhere', [$tableConfig['where']['cond']]);
            $datatableConfigDefinition->addMethodCall('setWhereParams', [$tableConfig['where']['params']]);
//            if (isset($tableConfig['joins'])) {
                $datatableConfigDefinition->addMethodCall('setJoins', [$tableConfig['joins']]);
//            } else {
//                $datatableConfigDefinition->addMethodCall('setJoins', [[]]);
//            }
            $datatableConfigDefinition->addMethodCall('setOrderField', [$tableConfig['order'][0]]);
            $datatableConfigDefinition->addMethodCall('setOrderDirection', [$tableConfig['order'][1]]);
            $datatableConfigDefinition->addMethodCall('setAction', [$tableConfig['action']]);
            $datatableConfigDefinition->addMethodCall('setSearch', [$tableConfig['search']]);
//            if (isset($tableConfig['search_fields'])) {
                $datatableConfigDefinition->addMethodCall('setSearchFields', [$tableConfig['search_fields']]);
//            } else {
//                $datatableConfigDefinition->addMethodCall('setSearchFields', [[]]);
//            }

            $datatableConfigDefinition->addTag('datatable.config');

            $datatableConfigDefinitions['datatable.config.'.$tableConfig['id']] = $datatableConfigDefinition;
        }

        $container->addDefinitions($datatableConfigDefinitions);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
