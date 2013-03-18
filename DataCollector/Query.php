<?php

namespace Smile\EzSqlProfilerBundle\DataCollector;

/**
 * Represent a Query that has been performed.
 */
class Query
{
    protected $sql;
    public $ezcQuery;
    protected $time = 0;

    public function __construct(\ezcQuery $query)
    {
        $this->ezcQuery = $query;
    }

    public function getSql()
    {
        return $this->sql;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time)
    {
        $this->time = $time;
    }
    /**
     * The profiler serialize/unserialize DataCollector before a call to "collectData".
     * For that reason, we can't keep a reference to the ezcQuery object.
     *
     * @see Symfony\Component\HttpKernel\Profiler\Profiler::collect
     *
     * @return string[]
     */
    public function __sleep()
    {
        if ( null !== $this->ezcQuery )
        {
            $this->sql = (string)$this->ezcQuery;
            $this->ezcQuery = null;
        }

        return array( 'sql', 'time' );
    }
}
