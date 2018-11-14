<?php

namespace timetables\cartesius;

/**
 * Class Datum.
 */
abstract class Datum implements Constraint
{
    /**
     * @var int
     */
    public $data = null;

    public $closeData = null;

    /**
     * @var int
     *          calculate how different the compared data values
     */
    public $dataDifference = 2;

    const EQUALS = 0;
    const CLOSE = 1;
    const NOT_MATCH = 2;

    /**
     * @var bool
     *           If the datum match with criteria, set this value to true
     */
    public $isFits = false;
}
