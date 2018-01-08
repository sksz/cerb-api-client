<?php
namespace Cerb;

class Result
{
    /**
     * @var array
     */
    private $results;
    /**
     * @var int
     */
    private $total;

    /**
     * @param array $results
     * @param int $total
     */
    public function __construct(array $results = [], $total = 1)
    {
        $this->results = $results;
        $this->total = $total;
    }

    /**
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }
}
