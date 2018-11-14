<?php

namespace timetables;

use timetables\cartesius\Cartesius;
use timetables\cartesius\Coordinates;
use timetables\cartesius\Datum;
use timetables\cartesius\Dimensions;
use timetables\cartesius\TimetableException;

/**
 * Class TimetableDriver
 * @package timetables
 */
class TimetableDriver
{

    /**
     * @var Datum
     */
    var $criteriaX;

    /**
     * @var Datum
     */
    var $criteriaY;

    /**
     * @var Dimensions
     */
    var $dimenX;

    /**
     * @var Dimensions
     */
    var $dimenY;

    /**
     * @var Cartesius
     */
    var $cartesius;

    /**
     * @var Coordinates
     */
    var $coordinate;

    public function __construct()
    {
        $this->dimenX = new Dimensions();
        $this->dimenY = new Dimensions();
        $this->cartesius = new Cartesius();
        $this->coordinate = new Coordinates();
    }

    /**
     * @param mixed $criteriaX
     * @return TimetableDriver
     */
    public function setCriteriaX($criteriaX)
    {
        $this->criteriaX = $criteriaX;
        return $this;
    }

    /**
     * @param mixed $criteriaY
     * @return TimetableDriver
     */
    public function setCriteriaY($criteriaY)
    {
        $this->criteriaY = $criteriaY;
        return $this;
    }

    /**
     * @param Datum $sampling
     * @param $index
     * @throws TimetableException
     */
    public function addDimenX(Datum $sampling, $index = null)
    {
        if (!$sampling instanceof Datum) {
            throw new TimetableException('Sample must be instance of Datum object');
        }
        if ($index === null) {
            $index = $this->dimenX->getSize();
        }
        $this->dimenX->add($index, $sampling);
    }

    /**
     * @param Datum $sampling
     * @param $index
     * @throws TimetableException
     */
    public function addDimenY(Datum $sampling, $index = null)
    {
        if (!$sampling instanceof Datum) {
            throw new TimetableException('Sample must be instance of Datum object');
        }
        if ($index === null) {
            $index = $this->dimenY->getSize();
        }
        $this->dimenY->add($index, $sampling);
    }

    /**
     * @throws TimetableException
     */
    public function CalculateTimeTable()
    {
        if ($this->dimenX->getSize() === 0) {
            throw new TimetableException('Sample must set first');
        }
        if ($this->dimenY->getSize() === 0) {
            throw new TimetableException('Sample must set first');
        }

        $this->cartesius->setXDimension($this->dimenX);
        $this->cartesius->setYDimension($this->dimenY);

        $this->cartesius->Visits($this->coordinate, $this->criteriaX, $this->criteriaY);

        if ($this->cartesius->limit === 0) {
            $remark = 'EXHAUSTED';
        } else {
            $remark = 'CLEAR';
        }

        return array(
            'BestX' => $this->cartesius->lastBestX,
            'BestY' => $this->cartesius->lastBestY,
            'Criteria' => array(
                'X' => $this->criteriaX->data,
                'Y' => $this->criteriaY->data,
            ),
            'Result' => array(
                'X' => $this->dimenX->get($this->cartesius->lastBestX)->data,
                'Y' => $this->dimenY->get($this->cartesius->lastBestY)->data,
            ),
            'Iteration' => $this->cartesius->iteration,
            'Remark' => $remark
        );
    }

}