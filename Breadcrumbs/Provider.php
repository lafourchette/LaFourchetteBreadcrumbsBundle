<?php

namespace LaFourchette\BreadcrumbsBundle\Breadcrumbs;

use LaFourchette\BreadcrumbsBundle\Breadcrumbs\Trail;
use LaFourchette\BreadcrumbsBundle\Breadcrumbs\Builder\BuilderInterface;

class Provider
{
    private $trails = array();

    public function addBuilder(BuilderInterface $builder)
    {
        foreach ($builder->registerTrails() as $name => $callback) {
            $this->trails[$name] = $callback;
        }
    }

    public function has($name)
    {
        return isset($this->trails[$name]);
    }

    public function get($name)
    {
        if (!$this->has($name)) {
            throw new \InvalidArgumentException(sprintf('Trail "%s" does not exist', $name));
        }

        if (!is_array($this->trails[$name])) {
            throw new \InvalidArgumentException(sprintf('Callback should be an array "%s" given', gettype($this->trails[$name])));
        }

        if (count($this->trails[$name]) !== 2) {
            throw new \InvalidArgumentException(sprintf('Callback should have only 2 parameters "%s" given', count($this->trails[$name])));
        }

        list($obj, $method) = $this->trails[$name];

        if (!$obj instanceof BuilderInterface) {
            throw new \InvalidArgumentException(sprintf('The first parameters in callback should be a BuilderInterface object "%s" given', gettype($obj)));
        }

        if (!method_exists($obj, $method)) {
            throw new \BadMethodCallException(sprintf('Method "%s" not found in class "%s"', $method, get_class($obj)));
        }

        return call_user_func_array($this->trails[$name], array());
    }

    public function all()
    {
        return $this->trails;
    }
}
