<?php

namespace Lexik\Bundle\PayboxBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('lexik_paybox');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()

                ->arrayNode('servers')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('primary')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('host')->defaultValue('https://tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi')->end()
                                ->scalarNode('incoming')->defaultValue('194.2.160.66')->end()
                                ->scalarNode('outgoing')->defaultValue('194.2.122.158')->end()
                            ->end()
                        ->end()
                        ->arrayNode('secondary')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('host')->defaultValue('https://tpeweb1.paybox.com/cgi/MYchoix_pagepaiement.cgi')->end()
                                ->scalarNode('incoming')->defaultValue('195.25.7.146')->end()
                                ->scalarNode('outgoing')->defaultValue('195.25.7.166')->end()
                            ->end()
                        ->end()
                        ->arrayNode('preprod')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('host')->defaultValue('https://preprod-tpeweb.paybox.com/cgi/MYchoix_pagepaiement.cgi')->end()
                                ->scalarNode('incoming')->defaultValue('195.101.99.72')->end()
                                ->scalarNode('outgoing')->defaultValue('195.101.99.76')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()

                ->arrayNode('parameters')
                    ->isRequired()
                    ->children()
                        ->scalarNode('site')->isRequired()->end()
                        ->scalarNode('rank')->isRequired()->end()
                        ->scalarNode('login')->isRequired()->end()
                        ->arrayNode('hmac')
                            ->isRequired()
                            ->children()
                                ->scalarNode('algorithm')->defaultValue('sha512')->end()
                                ->scalarNode('key')->isRequired()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()

            ->end()
        ;

        return $treeBuilder;
    }
}
