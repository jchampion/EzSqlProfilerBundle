<?php
/**
 * File containing the EzSystemsDemoBundle class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 5.0.0
 */
namespace Smile\EzSqlProfilerBundle;

use Symfony\Component\DependencyInjection\Compiler\PassConfig;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Smile\EzSqlProfilerBundle\DependencyInjection\Compiler\OverrideEzDbHandlerPass;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SmileEzSqlProfilerBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass( new OverrideEzDbHandlerPass(), PassConfig::TYPE_AFTER_REMOVING );
    }
}
