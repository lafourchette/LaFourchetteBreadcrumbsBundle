Using LaFourchetteBreadcrumbsBundle
===================

**Basic Docs**

* [Installation](#installation)
* [Your first breadcrumb](#first-builder)
* [Rendering breadcrumbs](#rendering-breadcrumbs)

<a name="installation"></a>

## Installation

### Step 1) Get the bundle and the library

First, grab LaFourchetteBreadcrumbsBundle. There are two different ways
to do this:

#### Method a) Using the `deps` file

Add the following lines to your  `deps` file and then run `php bin/vendors
install`:

```
[LaFourchetteBreadcrumbsBundle]
    git=https://github.com/lafourchette/LaFourchetteBreadcrumbsBundle.git
    target=bundles/LaFourchette/BreadcrumbsBundle
```

#### Method b) Using submodules

Run the following commands to bring in the needed libraries as submodules.

```bash
git submodule add https://github.com/lafourchette/LaFourchetteBreadcrumbsBundle.git vendor/bundles/LaFourchette/BreadcrumbsBundle
```

#### Method c) Using the `composer` file

Add the following lines to your  `composer.json` file and then run `php composer.phar
update`:

```
    ...
    "minimum-stability": "dev",

    require:
        {
        ...
        "lafourchette/breadcrumbs-bundle": "dev-master",
        ...
        }
    ...
```


### Step 2) Register the namespaces

Add the following two namespace entries to the `registerNamespaces` call
in your autoloader:

``` php
<?php
// app/autoload.php
$loader->registerNamespaces(array(
    // ...
    'LaFourchette' => __DIR__.'/../vendor/bundles',
    // ...
));
```

### Step 3) Register the bundle

To start using the bundle, register it in your Kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new LaFourchette\BreadcrumbsBundle\LaFourchetteBreadcrumbsBundle(),
    );
    // ...
}
```


<a name="first-builder"></a>

## Your first breadcrumbs builder

### Create the builder class

```php
<?php
// src/LaFourchette/DemoBundle/Breadcrumbs/DemoBreadcrumbsBuilder.php

namespace LaFourchette\DemoBundle\Breadcrumbs;

use LaFourchette\BreadcrumbsBundle\Breadcrumbs\Builder\AbstractBuilder;

class DemoBreadcrumbsBuilder extends AbstractBuilder
{
    public function buildHomepage()
    {
        $t = $this->createTrail();
        $t->add($this->createCrumb('Homepage', $this->container->get('router')->generate('homepage')));
        
        return $t;
    }

    public function registerTrails()
    {
        return array(
            'homepage' => array($this, 'buildHomepage'),
        );
    }
}

```

### Define the builder class as service

    <parameters>
        <parameter key="la_fourchette_demo.breadcrumbs_builder.class">LaFourchette\DemoBundle\Breadcrumbs\DemoBreadcrumbsBuilder</parameter>
    </parameters>

    <services>
        <service id="la_fourchette_demo.breadcrumbs_builder" class="%la_fourchette_demo.breadcrumbs_builder.class%">
            <call method="setContainer">
                <argument type="service" id="service_container" />
            </call>
            <tag name="la_fourchette_breadcrumbs.builder" />
        </service>
    </services>

<a name="rendering-breadcrumbs"></a>

## Rendering breadcrumbs

    {{ la_fourchette_breadcrumbs_render() }}