<?php

namespace tests;

use timetables\cartesius\Datum;

class RoomDatum extends Datum
{
    public function CalculateFits(Datum $comparator)
    {
        if ($comparator->data === $this->data) {
            return Datum::EQUALS;
        } elseif (in_array($this->data, $comparator->closeData)) {
            return Datum::CLOSE;
        }

        return Datum::NOT_MATCH;
    }
}
