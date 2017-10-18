<?php
namespace LiskPhpBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('lisk_php');

        $rootNode
            ->children()
            ->scalarNode('base_url')
                ->isRequired()
                ->cannotBeEmpty()
                ->end()
            ->scalarNode('network_hash')
                ->isRequired()
                ->cannotBeEmpty()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
