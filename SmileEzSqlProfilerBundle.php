<?php

namespace Smile\EzSqlProfilerBundle;

use Symfony\Component\DependencyInjection\Compiler\PassConfig;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Smile\EzSqlProfilerBundle\DependencyInjection\Compiler\OverrideEzDbHandlerPass;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SmileEzSqlProfilerBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build( $container );

        $container->addCompilerPass( new OverrideEzDbHandlerPass() );
    }
}
