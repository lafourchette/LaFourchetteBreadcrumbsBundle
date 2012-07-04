<?php

namespace LaFourchette\BreadcrumbsBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

class BreadcrumbsExtension extends \Twig_Extension
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            'la_fourchette_breadcrumbs_render' => new \Twig_Function_Method($this, 'render', array('is_safe' => array('html')))
        );
    }

    public function render($template = null, $root = 'default')
    {
        $template = $template ?: $this->container->getParameter('la_fourchette_breadcrumbs.template');
        $route = $this->container->get('request')->get('_route');

        if ($this->container->get('la_fourchette_breadcrumbs.provider')->has($route)) {
            $trail = $this->container->get('la_fourchette_breadcrumbs.provider')->get($route);

            return $this->container->get('templating')->render($template, array('trail' => $trail));
        }
    }

    public function getName()
    {
        return 'la_fourchette_breadcrumbs';
    }
}
