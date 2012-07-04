<?php

namespace LaFourchette\BreadcrumbsBundle\Tests\Breadcrumbs;

use LaFourchette\BreadcrumbsBundle\Breadcrumbs\Provider;
use LaFourchette\BreadcrumbsBundle\Breadcrumbs\Trail;
use LaFourchette\BreadcrumbsBundle\Breadcrumbs\Crumb;

class ProviderTest extends \PHPUnit_Framework_TestCase
{
    private $provider;

    public function setUp()
    {
        $this->provider = new Provider();
    }

    public function testAddBuilder()
    {
        $builder = $this->getBuilderMock();
        $this->provider->addBuilder($builder);

        $this->assertEquals(1, count($this->provider->all()));
    }

    public function testHas()
    {
        $builder = $this->getBuilderMock();
        $this->provider->addBuilder($builder);

        $this->assertTrue($this->provider->has('foo'));
        $this->assertFalse($this->provider->has('bar'));
    }

    public function testGet()
    {
        $builder = $this->getBuilderMock();
        $this->provider->addBuilder($builder);

        $this->assertInstanceOf('LaFourchette\BreadcrumbsBundle\Breadcrumbs\Trail', $this->provider->get('foo'));
        $this->assertEquals($this->getDefaultTrail(), $this->provider->get('foo'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetUnregisteredTrail()
    {
        $builder = $this->getBuilderMock();
        $this->provider->addBuilder($builder);

        $this->provider->get('bar');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetWhereCallbackIsNotAnArray()
    {
        $builder = $this->getMock('LaFourchette\BreadcrumbsBundle\Breadcrumbs\Builder\BuilderInterface', array('buildFoo', 'registerTrails'));
        $builder->expects($this->any())
                ->method('buildFoo')
                ->will($this->returnValue($this->getDefaultTrail()));

        $builder->expects($this->any())
                ->method('registerTrails')
                ->will($this->returnValue(array('foo' => false)));

        $this->provider->addBuilder($builder);

        $this->provider->get('foo');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetWithCallbackWithOneParameter()
    {
        $builder = $this->getMock('LaFourchette\BreadcrumbsBundle\Breadcrumbs\Builder\BuilderInterface', array('buildFoo', 'registerTrails'));
        $builder->expects($this->any())
                ->method('buildFoo')
                ->will($this->returnValue($this->getDefaultTrail()));

        $builder->expects($this->any())
                ->method('registerTrails')
                ->will($this->returnValue(array('foo' => array($builder))));

        $this->provider->addBuilder($builder);

        $this->provider->get('foo');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetWhereFirstParamsInCallbackIsNotABuilder()
    {
        $builder = $this->getMock('LaFourchette\BreadcrumbsBundle\Breadcrumbs\Builder\BuilderInterface', array('buildFoo', 'registerTrails'));
        $builder->expects($this->any())
                ->method('buildFoo')
                ->will($this->returnValue($this->getDefaultTrail()));

        $builder->expects($this->any())
                ->method('registerTrails')
                ->will($this->returnValue(array('foo' => array('foo', 'buildbar'))));

        $this->provider->addBuilder($builder);

        $this->provider->get('foo');
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testGetWhereMethodInCallbackDoesNotExist()
    {
        $builder = $this->getMock('LaFourchette\BreadcrumbsBundle\Breadcrumbs\Builder\BuilderInterface', array('buildFoo', 'registerTrails'));
        $builder->expects($this->any())
                ->method('buildFoo')
                ->will($this->returnValue($this->getDefaultTrail()));

        $builder->expects($this->any())
                ->method('registerTrails')
                ->will($this->returnValue(array('foo' => array($builder, 'buildbar'))));

        $this->provider->addBuilder($builder);

        $this->provider->get('foo');
    }

    protected function getDefaultTrail()
    {
        $trail = new Trail();
        $trail->add(new Crumb('foo', '/'));

        return $trail;
    }

    protected function getBuilderMock()
    {
        $builder = $this->getMock('LaFourchette\BreadcrumbsBundle\Breadcrumbs\Builder\BuilderInterface', array('buildFoo', 'registerTrails'));
        $builder->expects($this->any())
                ->method('buildFoo')
                ->will($this->returnValue($this->getDefaultTrail()));

        $builder->expects($this->any())
                ->method('registerTrails')
                ->will($this->returnValue(array('foo' => array($builder, 'buildFoo'))));

        return $builder;
    }
}
