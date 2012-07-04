<?php

namespace LaFourchette\BreadcrumbsBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class AddBreadcrumbsBuilderPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('la_fourchette_breadcrumbs.provider')) {
            return;
        }

        $provider = $container->getDefinition('la_fourchette_breadcrumbs.provider');
        foreach ($container->findTaggedServiceIds('la_fourchette_breadcrumbs.builder') as $id => $attr) {
            $provider->addMethodCall('addBuilder', array(new Reference($id)));
        }
    }
}
