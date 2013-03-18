<?php
/**
 * File containing the eZDemoExtension class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 5.0.0
 */

namespace Smile\EzSqlProfilerBundle\DependencyInjection;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

class SmileEzSqlProfilerExtension extends Extension
{
    /**
     * Loads a specific configuration.
     *
     * @param array            $config    An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     *
     * @throws InvalidArgumentException When provided tag is not defined in this extension
     *
     * @api
     */
    public function load( array $config, ContainerBuilder $container )
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator( __DIR__ . '/../Resources/config' )
        );

        $loader->load( 'services.xml' );
    }
}
