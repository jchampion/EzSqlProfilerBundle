<?php
namespace Smile\EzSqlProfilerBundle\DependencyInjection;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

class SmileEzSqlProfilerExtension extends Extension
{
    public function load( array $config, ContainerBuilder $container )
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator( __DIR__ . '/../Resources/config' )
        );

        $loader->load( 'services.xml' );
    }
}
