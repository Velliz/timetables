<?php

namespace timetables\cartesius;

/**
 * Class Datum
 * @package timetables
 */
abstract class Datum implements Constraint
{

    /**
     * @var int
     */
    var $data = null;

    var $closeData = null;

    /**
     * @var int
     * calculate how different the compared data values
     */
    var $dataDifference = 2;

    const EQUALS = 0;
    const CLOSE = 1;
    const NOT_MATCH = 2;

    /**
     * @var bool
     * If the datum match with criteria, set this value to true
     */
    var $isFits = false;

}