<?php

namespace Smile\EzSqlProfilerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\DefinitionDecorator;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Alias;

class OverrideEzDbHandlerPass implements CompilerPassInterface
{
    const EZP_DBHANDLER_ID      = 'ezpublish.api.storage_engine.legacy.dbhandler';
    const EZP_DBHFACTORY_ID     = 'ezpublish.api.storage_engine.legacy.dbhandler.factory';
    const SMILE_DECORATOR_CLASS = 'Smile\EzSqlProfilerBundle\Override\DbHandlerOverride';
    const SMILE_FACTORY_CLASS   = 'Smile\EzSqlProfilerBundle\Override\DbHandlerFactoryOverride';
    
    public function process(ContainerBuilder $container)
    {
        if ( !$container->hasDefinition( self::EZP_DBHANDLER_ID ) ) {
            return;
        }

        $container->getDefinition( self::EZP_DBHANDLER_ID )->setClass(
            self::SMILE_DECORATOR_CLASS
        );

        $container->getDefinition( self::EZP_DBHFACTORY_ID )->setClass(
            self::SMILE_FACTORY_CLASS
        );
    }
}