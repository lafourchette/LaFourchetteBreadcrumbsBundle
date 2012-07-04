<?php

namespace LaFourchette\BreadcrumbsBundle\Breadcrumbs\Builder;

use LaFourchette\BreadcrumbsBundle\Breadcrumbs\Trail;
use LaFourchette\BreadcrumbsBundle\Breadcrumbs\Crumb;
use Symfony\Component\DependencyInjection\ContainerAware;

abstract class AbstractBuilder extends ContainerAware implements BuilderInterface
{
    public function createTrail()
    {
        return new Trail();
    }

    public function createCrumb($title, $uri = null)
    {
        return new Crumb($title, $uri);
    }
}
