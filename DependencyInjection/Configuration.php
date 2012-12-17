<?php

namespace r1pp3rj4ck\GoogleBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder,
    Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('r1pp3rj4ck_google');

        $rootNode
            ->children()
                ->arrayNode('auth')
                    ->children()
                        ->scalarNode('app_name')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('client_id')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('client_secret')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('developer_key')->isRequired()->cannotBeEmpty()->end()
                    ->end()
                ->end()
                ->arrayNode('route')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('name')->defaultValue('')->end()
                        ->arrayNode('params')->end()
                    ->end()
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}