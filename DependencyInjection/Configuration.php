<?php

namespace LaFourchette\BreadcrumbsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class contains the configuration information for the bundle
 *
 * @author Jimmy Leger <jleger@lafourchette.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('lafourchette_breadcrumbs');

        $rootNode
            ->children()
                ->scalarNode('template')->defaultValue('LaFourchetteBreadcrumbsBundle:Breadcrumbs:la_fourchette_breadcrumb.html.twig')->cannotBeEmpty()->end()
            ->end()
         ;

        return $treeBuilder;
    }
}
