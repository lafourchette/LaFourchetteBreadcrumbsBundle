<?php

namespace LaFourchette\BreadcrumbsBundle\Breadcrumbs;

class Trail
{
    private $crumbs = array();

    public function add(Crumb $crumb)
    {
        $this->crumbs[] = $crumb;
        $crumb->setTrail($this);

        return $this;
    }

    public function getFirst()
    {
        if (count($this->crumbs) > 0) {
            return $this->crumbs[0];
        }

        return false;
    }

    public function getLast()
    {
        if (count($this->crumbs) > 0) {
            return $this->crumbs[count($this->crumbs)-1];
        }

        return false;
    }

    public function getCrumbs()
    {
        return $this->crumbs;
    }
}
