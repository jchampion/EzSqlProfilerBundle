<?php



namespace Smile\EzSqlProfilerBundle\Override;

use eZ\Publish\Core\MVC\ConfigResolverInterface;

/**
 * Force the class name to be DbHandlerOverride instead of \ezcDbHandler
 *
 * @author cyril.quintin@gmail.com
 */
class DbHandlerFactoryOverride extends \eZ\Bundle\EzPublishCoreBundle\ApiLoader\LegacyDbHandlerFactory
{
    /**
     * Builds the DB handler used by the legacy storage engine.
     *
     * @return \eZ\Publish\Core\Persistence\Legacy\EzcDbHandler
     */
    public function buildLegacyDbHandler()
    {
        return DbHandlerOverride::create(
            $this->configResolver->getParameter( 'database.params' )
        );
    }
}
