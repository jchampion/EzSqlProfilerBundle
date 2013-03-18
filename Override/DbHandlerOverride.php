<?php

namespace Smile\EzSqlProfilerBundle\Override;
use eZ\Publish\Core\Persistence\Legacy\EzcDbHandler;
use Smile\EzSqlProfilerBundle\DataCollector\Query;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * The execution time infos is a dirty approximation :
 *
 * - Time from now to the previous query.
 *
 * this can be cleaner with more override and PDO decorator (that compute ::exec and ::query time
 *
 * @author cyril.quintin@gmail.com
 */
class DbHandlerOverride extends EzcDbHandler
{
    protected $queries    = array();
    /**
     * @return number the number of queries
     */
    public function getQueryCount()
    {
        return count( $this->queries );
    }
    /**
     * {@inheritdoc} Hold a reference to returned query objects
     */
    public function __call( $method, $parameters )
    {
        static $diffTime = 0;

        if ( in_array( $method, array( 'createSelectQuery', 'createFindQuery', 'createUpdateQuery' ) ) )
        {
            $q       = call_user_func_array( array( $this->ezcDbHandler, $method ), $parameters );
            $pq      = new Query( $q );
            $newTime = microtime( true );

            if ( $diffTime > 0.00000 )
            {
                $pq->setTime( $newTime - $diffTime );
            }

            $this->queries[] = $pq;
            $diffTime        = $newTime;
            return $q;
        }

        return call_user_func_array( array( $this->ezcDbHandler, $method ), $parameters );
    }
    /**
     * @return Smile\EzSqlProfilerBundle\DataCollector\Query[] the list of executed queries
     */
    public function getQueries()
    {
        return $this->queries;
    }
    /**
     * {@inheritdoc} override needed As the keyword is "self". A late static binding would have been super welcome
     */
    public static function create( $dbParams )
    {
        if ( !is_array( $dbParams ) )
        {
            $databaseType = preg_replace( '(^([a-z]+).*)', '\\1', $dbParams );
        }
        else
        {
            $databaseType = $dbParams['type'];
            // PDOMySQL ignores the "charset" param until PHP 5.3.6.
            // We then need to force it to use an init command.
            // @link http://php.net/manual/en/ref.pdo-mysql.connection.php
            if ( $databaseType === 'mysql' && $dbParams['charset'] === 'utf8' )
            {
                $dbParams['driver-opts'] += array(
                    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                );
            }
        }

        $connection = \ezcDbFactory::create( $dbParams );

        switch ( $databaseType )
        {
            case 'pgsql':
                $dbHandler = new Pgsql( $connection );
                break;

            case 'sqlite':
                $dbHandler = new Sqlite( $connection );
                break;

            default:
                $dbHandler = new self( $connection );
        }
        return $dbHandler;
    }
}
