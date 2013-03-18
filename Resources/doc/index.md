EzSqlProfilerBundle
===================

This bundle provide an SQL debug bar for Symfony pages that use EzPublish 5 API.
 
The images used and most of the templating come from @DoctrineBundle/Resources/Collector/db.html.twig.

WARNING
-------

The query times are raw estimations.
Getting the real execution time is much more tricky and there will probably be an official debug bar sooner or later.
With this estimation method, Queries may actually take less than displayed but not more.
So a slow query is probably slow and may be "not that slow".

Installation
------------

### Step 1-A: Download SmileEzSqlProfilerBundle using composer

Add the bundle in your composer.json:

```js
{
    "require": {
        "smile/ez-sqlprofiler-bundle": "*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update smile/ez-slprofiler-bundle
```

Composer will install the bundle to your project's `vendor/smile/ez-slprofiler-bundle` directory.

### Step 1-B : Download SmileEzSqlProfilerBundle using your fingers

Unfortunately that's probably the way to go for Ez Publish Enterprise as EzSystem do not provide the composer.json.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Smile\EzSqlProfilerBundle\SmileEzSqlProfilerBundle(),
    );
}
```