Using LaFourchetteBreadcrumbsBundle
===================

**Basic Docs**

* [Installation](#installation)
* [Your first breadcrumb](#first-breadcrumb)
* [Rendering Menus](#rendering-breadcrumbs)

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