<?php

namespace timetables\cartesius;

/**
 * Class Dimensions
 * @package timetables
 */
class Dimensions
{

    /**
     * @var array|Datum
     */
    private $dimension = array();

    /**
     * @param $key
     * @param $datum
     * @throws TimetableException
     */
    public function add($key, $datum)
    {
        if (!$datum instanceof Datum) {
            throw new TimetableException("Dimensions data must instance of Datum");
        }
        $this->dimension[$key] = $datum;
    }

    public function getSize()
    {
        return sizeof($this->dimension);
    }

    /**
     * @param $index
     * @return Datum
     */
    public function get($index)
    {
        return $this->dimension[$index];
    }

    public function clear()
    {
        $this->dimension = array();
    }

}