<?php

namespace timetables\cartesius;

/**
 * Interface Constraint
 * @package timetables
 */
interface Constraint
{

    public function CalculateFits(Datum $comparator);


}