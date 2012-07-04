<?php

namespace LaFourchette\BreadcrumbsBundle\Tests\Breadcrumbs;

use LaFourchette\BreadcrumbsBundle\Breadcrumbs\Trail;
use LaFourchette\BreadcrumbsBundle\Breadcrumbs\Crumb;

class TrailTest extends \PHPUnit_Framework_TestCase
{
    public function testCrumbs()
    {
        $trail = new Trail();
        $crumb1 = new Crumb('homepage', '/');
        $crumb2 = new Crumb('foo', '/foo');

        $this->assertEquals(0, count($trail->getCrumbs()));

        $trail->add($crumb1);
        $this->assertEquals(1, count($trail->getCrumbs()));

        $trail->add($crumb2);
        $this->assertEquals(2, count($trail->getCrumbs()));

        $expected = array($crumb1, $crumb2);
        $this->assertEquals($expected, $trail->getCrumbs());
    }

    public function testAdd()
    {
        $trail = new Trail();
        $crumb0 = new Crumb('homepage', '/');
        $crumb1 = new Crumb('foo', '/foo');

        $trail->add($crumb0);
        $this->assertEquals($trail, $crumb0->getTrail());
    }
}
