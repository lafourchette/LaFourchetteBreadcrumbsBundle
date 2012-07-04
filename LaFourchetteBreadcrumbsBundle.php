<?php

namespace LaFourchette\BreadcrumbsBundle;

use LaFourchette\BreadcrumbsBundle\DependencyInjection\Compiler\AddBreadcrumbsBuilderPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class LaFourchetteBreadcrumbsBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AddBreadcrumbsBuilderPass());
    }
}
