<?php

namespace Smile\EzSqlProfilerBundle\DataCollector;


use Symfony\Component\DependencyInjection\Container;

use eZ\Publish\Core\Persistence\Legacy\EzcDbHandler;

use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DbHandlerDataCollector extends \Symfony\Component\HttpKernel\DataCollector\DataCollector
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->data = array(
            'querycount' => 0,
            'queries'    => array()
        );
    }
    /**
     * {@inheritdoc}
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    { 
        $dbh = $this->container->get('ezpublish.api.storage_engine.legacy.dbhandler');
        $qlist = $dbh->getQueries();
        
        
        $this->data = array(
            'querycount' => $dbh->getQueryCount(),
            'queries'    => $dbh->getQueries()
        );
    }

    public function getQueryCount()
    {
        return array_key_exists('querycount', $this->data) ? $this->data['querycount'] : 0;
    }

    public function getTime()
    {
        if (!array_key_exists('queries', $this->data)) {
            return 0;
        }
        $time = 0;
        
        foreach ($this->data['queries'] as $q) {
            $time += $q->getTime();            
        }
        
        return $time;
    }

    public function getQueries()
    {
        return array_key_exists('queries', $this->data) ? $this->data['queries'] : array();
    }

    public function getName()
    {
        return 'ezsql';
    }
}