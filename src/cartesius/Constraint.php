<?php

namespace timetables\cartesius;

/**
 * Interface Constraint.
 */
interface Constraint
{
    public function CalculateFits(Datum $comparator);
}
