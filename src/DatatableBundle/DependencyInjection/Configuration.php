<?php

namespace RP\DatatableBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('rp_datatable');
        $rootNode
            ->children()
                ->arrayNode('datatables')
                    ->requiresAtLeastOneElement()
                    ->prototype('array')
                        ->children()
                            ->scalarNode('id')->isRequired()->end()
                            ->arrayNode('entity')
                                ->isRequired()
                                ->children()
                                    ->scalarNode('name')->end()
                                    ->scalarNode('alias')->end()
                                ->end()
                            ->end()
                            ->arrayNode('fields')
                                ->isRequired()
                                ->prototype('scalar')->end()
                            ->end()
                            ->arrayNode('renderers')
                                ->prototype('array')
                                    ->children()
                                        ->scalarNode('view')->isRequired()->end()
                                        ->arrayNode('params')
                                            ->prototype('scalar')->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                            ->arrayNode('joins')
                                ->prototype('array')
                                    ->children()
                                        ->scalarNode('field')->isRequired()->end()
                                        ->scalarNode('alias')->isRequired()->end()
                                        ->scalarNode('type')->defaultValue('LEFT')->end()
                                    ->end()
                                ->end()
                            ->end()
                            ->arrayNode('where')
                                ->children()
                                    ->scalarNode('cond')->isRequired()->end()
                                    ->arrayNode('params')
                                        ->prototype('scalar')->end()
                                    ->end()
                                ->end()
                            ->end()
                            ->arrayNode('order')
                                ->isRequired()
                                ->children()
                                    ->scalarNode('0')->isRequired()->end()
                                    ->enumNode('1')->values(['asc', 'desc'])->defaultValue('asc')->end()
                                ->end()
                            ->end()
                            ->booleanNode('action')->defaultFalse()->end()
                            ->booleanNode('search')->defaultFalse()->end()
                            ->arrayNode('search_fields')
                                ->prototype('scalar')
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
