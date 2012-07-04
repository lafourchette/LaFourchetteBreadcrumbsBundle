<?php

namespace LaFourchette\BreadcrumbsBundle\Breadcrumbs;

final class Crumb
{
    private $title;
    private $uri;
    private $trail;

    public function __construct($title, $uri = null)
    {
        $this->title = $title;
        $this->uri = $uri;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setUri($uri = null)
    {
        $this->uri = $uri;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function hasUri()
    {
        return $this->uri !== null;
    }

    public function setTrail(Trail $trail)
    {
        $this->trail = $trail;
    }

    public function getTrail()
    {
        return $this->trail;
    }

    public function isFirst()
    {
        if (null !== $this->trail) {
            $crumb = $this->trail->getFirst();
            if ($crumb) {
                return $crumb === $this;
            }
        }

        return false;
    }

    public function isLast()
    {
        if (null !== $this->trail) {
            $crumb = $this->trail->getLast();
            if ($crumb) {
                return $crumb === $this;
            }
        }

        return false;
    }
}
