<?php



namespace Smile\EzSqlProfilerBundle\Override;
use eZ\Bundle\EzPublishCoreBundle\ApiLoader\LegacyDbHandlerFactory;

/**
 * Force the class name to be DbHandlerOverride instead of \ezcDbHandler
 *
 * @author cyril.quintin@gmail.com
 */
class DbHandlerFactoryOverride extends LegacyDbHandlerFactory
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
